import mysql.connector
from mysql.connector import Error

config = {
    'host': 'localhost',
    'user': 'phpmyadmin',
    'password': 'admin',
    'database': 'utmsearch_w',
    'charset': 'utf8mb4'
}

conn = None
cursor = None

try:
    conn = mysql.connector.connect(**config)
    cursor = conn.cursor()

    # 1. Création table diplômes uniques avec id_institut et annee
    cursor.execute("""
    CREATE TABLE IF NOT EXISTS utm_diplomes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        diplome VARCHAR(255) NOT NULL UNIQUE,
        id_institut INT DEFAULT NULL,
        annee VARCHAR(20) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    """)

    # 2. Création table lien diplôme-master
    cursor.execute("""
    CREATE TABLE IF NOT EXISTS utm_diplome_master (
        id INT AUTO_INCREMENT PRIMARY KEY,
        utm_diplome_id INT NOT NULL,
        master_id INT NOT NULL,
        annee VARCHAR(20),
        date_creation DATETIME,
        user_id INT,
        FOREIGN KEY (utm_diplome_id) REFERENCES utm_diplomes(id)
            ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    """)

    conn.commit()

    # 3. Insérer diplômes uniques depuis la table actuelle
    # Ici, comme la table d'origine 'utm_diplome' a déjà une colonne 'annee',
    # on va essayer d'insérer aussi l'année (en faisant attention aux doublons de diplome + annee)

    # Pour éviter doublons sur diplome+annee, on peut insérer les couples distincts
    cursor.execute("SELECT DISTINCT diplome, annee FROM utm_diplome;")
    diplomes_annees = cursor.fetchall()

    for diplome, annee in diplomes_annees:
        try:
            # On ignore les doublons (sur diplome seulement) => attention: ici on perdrait des annees différentes si même diplome existe plusieurs fois avec annees différentes
            # Si tu veux gérer diplome+annee uniques, il faudrait changer la clé UNIQUE en combinée (diplome, annee)
            cursor.execute("""
                INSERT IGNORE INTO utm_diplomes (diplome, annee)
                VALUES (%s, %s);
            """, (diplome, annee))
        except Error as e:
            print(f"Erreur insertion diplôme {diplome} avec année {annee}: {e}")

    conn.commit()

    # 4. Mettre à jour id_institut à 8 pour tous les diplômes
    cursor.execute("UPDATE utm_diplomes SET id_institut = 8;")
    conn.commit()

    # 5. Construire mapping diplome -> id dans utm_diplomes
    cursor.execute("SELECT id, diplome FROM utm_diplomes;")
    mapping = {diplome: id_ for id_, diplome in cursor.fetchall()}

    # 6. Récupérer toutes les données de la table actuelle
    cursor.execute("""
        SELECT id, diplome, master_id, annee, date_creation, user_id
        FROM utm_diplome;
    """)
    rows = cursor.fetchall()

    # 7. Insérer dans utm_diplome_master
    for row in rows:
        _, diplome, master_id, annee, date_creation, user_id = row
        utm_diplome_id = mapping.get(diplome)
        if utm_diplome_id is None:
            print(f"WARNING: Diplôme non trouvé dans mapping: {diplome}")
            continue

        try:
            cursor.execute("""
                INSERT INTO utm_diplome_master
                (utm_diplome_id, master_id, annee, date_creation, user_id)
                VALUES (%s, %s, %s, %s, %s);
            """, (utm_diplome_id, master_id, annee, date_creation, user_id))
        except Error as e:
            print(f"Erreur insertion utm_diplome_master pour diplôme {diplome} master_id {master_id}: {e}")

    conn.commit()

    print("Migration terminée avec succès.")

except Error as e:
    print(f"Erreur MySQL : {e}")

finally:
    if cursor:
        cursor.close()
    if conn:
        conn.close()
