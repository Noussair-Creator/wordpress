import pandas as pd
import mysql.connector
from mysql.connector import Error
from datetime import datetime
import unicodedata

# Paramètres MySQL
config = {
    'host': 'localhost',
    'user': 'phpmyadmin',
    'password': 'admin',
    'database': 'utmsearch_w',
    'charset': 'utf8mb4'
}

# Fichier Excel
fichier_excel = 'Liste masters FDSPT.xlsx'

# Supprimer les accents des noms de colonnes
def remove_accents(s):
    return ''.join(c for c in unicodedata.normalize('NFD', s) if unicodedata.category(c) != 'Mn')

# Lire Excel et normaliser les colonnes
df = pd.read_excel(fichier_excel)
df.columns = [remove_accents(col.strip().lower().replace(" ", "_")) for col in df.columns]

# Renommer les colonnes pour correspondre aux noms attendus
df.rename(columns={
    'masteres': 'intitule_master',
    'diplome': 'diplome',
    'annee': 'annee'
}, inplace=True)

# Fonction sécurisée
def safe(val):
    return None if pd.isna(val) else str(val).strip()

try:
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()
    now = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    for index, row in df.iterrows():
        ordre = safe(row['ordre'])
        listes = safe(row['listes'])
        intitule_master = safe(row['intitule_master'])
        diplome = safe(row['diplome'])
        annee = safe(row['annee'])

        if not intitule_master:
            continue

        # 1. Vérifier / insérer le master
        cursor.execute("SELECT id FROM utm_master_fichemaster WHERE intitule_master = %s", (intitule_master,))
        result = cursor.fetchone()
        if result:
            master_id = result[0]
        else:
            cursor.execute(
                "INSERT INTO utm_master_fichemaster (intitule_master, institut_id, date_creation) VALUES (%s, %s, %s)",
                (intitule_master, 8, now)
            )
            conn.commit()
            master_id = cursor.lastrowid

        # 2. Vérifier / insérer le diplôme
        diplome_id = None
        if diplome:
            cursor.execute(
                "SELECT id FROM utm_diplome WHERE diplome = %s AND master_id = %s AND annee = %s",
                (diplome, master_id, annee)
            )
            result = cursor.fetchone()
            if result:
                diplome_id = result[0]
            else:
                cursor.execute("""
                    INSERT INTO utm_diplome (diplome, master_id, annee, date_creation)
                    VALUES (%s, %s, %s, %s)
                """, (diplome, master_id, annee, now))
                conn.commit()
                diplome_id = cursor.lastrowid

        # 3. Vérifier / insérer dans utm_liste_master
        cursor.execute("SELECT id FROM utm_liste_master WHERE ordre = %s AND listes = %s", (ordre, listes))
        result = cursor.fetchone()
        if result:
            liste_master_id = result[0]
        else:
            cursor.execute("""
                INSERT INTO utm_liste_master (ordre, listes, date_creation)
                VALUES (%s, %s, %s)
            """, (ordre, listes, now))
            conn.commit()
            liste_master_id = cursor.lastrowid

        # 4. Vérifier / insérer dans utm_liste_master_diplome
        if master_id and diplome_id:
            cursor.execute("""
                SELECT id FROM utm_liste_master_diplome
                WHERE liste_master_id = %s AND master_id = %s AND diplome_id = %s
            """, (liste_master_id, master_id, diplome_id))
            if not cursor.fetchone():
                cursor.execute("""
                    INSERT INTO utm_liste_master_diplome (liste_master_id, master_id, diplome_id, date_creation)
                    VALUES (%s, %s, %s, %s)
                """, (liste_master_id, master_id, diplome_id, now))
                conn.commit()

    print("✅ Importation terminée avec succès.")

except Error as e:
    print(f"❌ Erreur MySQL : {e}")

finally:
    if conn.is_connected():
        cursor.close()
        conn.close()
