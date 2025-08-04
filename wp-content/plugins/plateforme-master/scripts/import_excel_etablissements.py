import pandas as pd
import mysql.connector
from mysql.connector import Error
from datetime import datetime

# 🔧 Paramètres de connexion MySQL
config = {
    'host': 'localhost',
    'user': 'phpmyadmin',
    'password': 'admin',
    'database': 'utmsearch_w',
    'charset': 'utf8mb4'
}

# 📁 Charger le fichier Excel
fichier_excel = 'utm_master_etablissements.xlsx'
df = pd.read_excel(fichier_excel)

# 🧹 Nettoyer les noms de colonnes
df.columns = [col.strip().lower().replace(" ", "_") for col in df.columns]




try:
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()

    for index, row in df.iterrows():
        nom_universite = row['nom_universite'].strip()

        # 🔍 Vérifier si l'université existe
        cursor.execute("SELECT id FROM utm_universites WHERE nom_universite = %s", (nom_universite,))
        result = cursor.fetchone()

        if result:
            universite_id = result[0]
        else:
            cursor.execute("INSERT INTO utm_universites (nom_universite) VALUES (%s)", (nom_universite,))
            conn.commit()
            universite_id = cursor.lastrowid

        # 🛠️ Conversion sécurisée de la date
        try:
            date_creation = pd.to_datetime(row['date_creation'], errors='coerce')
            date_creation = date_creation.strftime('%Y-%m-%d') if not pd.isnull(date_creation) else None
        except:
            date_creation = None

        # 🏫 Insérer l'établissement
        def safe(val):
            return None if pd.isna(val) else str(val).strip()

        cursor.execute("""
            INSERT INTO utm_etablissements (
                universite_id, nom, categorie, code_institut, adresse, gouvernorat,
                email_contact, telephone_contact, responsable_nom, responsable_email, date_creation
            ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
        """, (
            universite_id,
            safe(row['nom']),
            safe(row['catégorie']),
            safe(row['code_institut']),
            safe(row.get('adresse', '')),
            safe(row.get('gouvernorat', '')),
            safe(row.get('email_contact', '')),
            safe(row.get('telephone_contact', '')),
            safe(row.get('responsable_nom', '')),
            safe(row.get('responsable_email', '')),
            safe(row['date_creation'])
        ))

        conn.commit()

    print("✅ Importation terminée avec succès.")

except Error as e:
    print(f"❌ Erreur MySQL : {e}")

finally:
    if conn.is_connected():
        cursor.close()
        conn.close()
