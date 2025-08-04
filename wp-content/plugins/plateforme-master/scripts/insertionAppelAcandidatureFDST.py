import mysql.connector

# Configuration MySQL
config = {
    'host': 'localhost',
    'user': 'phpmyadmin',
    'password': 'admin',
    'database': 'utmsearch_w',
    'charset': 'utf8mb4'
}

try:
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()

    # Étape 1 : Insérer un nouvel appel dans appels_candidature
    titre_appel = "Master FDST"

    cursor.execute("""
        INSERT INTO utm_master_appels_candidature (titre)
        VALUES (%s)
    """, (titre_appel,))
    appel_id = cursor.lastrowid
    print(f"✅ Appel 'Master FDST' inséré avec ID {appel_id}")

    # Étape 2 : Créer une entrée dans appels_sessions avec ce même ID
    date_debut = '2025-07-01'
    date_fin = '2025-08-31'

    cursor.execute("""
        INSERT INTO utm_master_appels_sessions (appel_id, nom_session, date_debut, date_fin)
        VALUES (%s, %s, %s, %s)
    """, (appel_id, titre_appel, date_debut, date_fin))

    print("✅ Appel inséré dans utm_master_appels_sessions.")

    # Étape 3 : Récupérer les masters de l’institut FDST (id=8)
    cursor.execute("SELECT id FROM utm_master_fichemaster WHERE institut_id = 8")
    master_ids = [row[0] for row in cursor.fetchall()]
    print(f"✅ {len(master_ids)} masters trouvés pour institut 8.")

    # Étape 4 : Lier les masters à l’appel
    for master_id in master_ids:
        cursor.execute("""
            INSERT IGNORE INTO utm_master_appels_masters (appel_id, master_id)
            VALUES (%s, %s)
        """, (appel_id, master_id))
    print("✅ Masters liés à l’appel.")

    # Étape 5 : Créer une session "publié web" pour chaque master
    for master_id in master_ids:
        cursor.execute("""
            INSERT IGNORE INTO utm_master_sessions (master_id, intitule_session, etat)
            VALUES (%s, %s, %s)
        """, (master_id, '2025-2026', 'publié web'))
    print("✅ Sessions créées pour les masters.")

    conn.commit()
    print("✅ Toutes les opérations ont été enregistrées avec succès.")

except mysql.connector.Error as err:
    print(f"❌ Erreur MySQL : {err}")

finally:
    if conn.is_connected():
        cursor.close()
        conn.close()
        print("🔒 Connexion fermée.")
