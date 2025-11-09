SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

START TRANSACTION;

-- Insertion des filières dans la table streams
INSERT INTO streams (stream_code, stream_name) VALUES
('GL',  'Génie logiciel'),
('GC',  'Génie civil'),
('ELT', 'Electrotechnique'),
('RT',  'Réseaux et télécommunication'),
('CO',  'Communication'),
('CI',  'Commerce international'),
('CF',  'Comptabilité et finance'),
('FB',  'Finance et banque'),
('DP',  'Droit privé'),
('LT',  'Gestion logistique et transport');


-- Insertion des étudiants dans la table students
-- =========================
-- Étudiants : Génie logiciel (GL)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Koffi', 'Mensah', '2000-05-12', 'Lomé', 'M', 'Rue 12 Kodjoviakopé', 'Lomé', 'Togo', '+22890000101', 'koffi.mensah.gl@example.com', 'Licence', 'L3', 'GL'),
('Awa', 'Johnson', '2001-03-20', 'Accra', 'F', 'Rue 45 Osu', 'Accra', 'Ghana', '+23354000102', 'awa.johnson.gl@example.com', 'Licence', 'L2', 'GL'),
('Jean', 'Dupont', '1999-11-02', 'Paris', 'M', 'Rue Victor Hugo', 'Paris', 'France', '+33160000103', 'jean.dupont.gl@example.com', 'Master', 'M1', 'GL'),
('Esi', 'Adzo', '2002-01-15', 'Lomé', 'F', 'Rue 23 Hedzranawoé', 'Lomé', 'Togo', '+22890000104', 'esi.adzo.gl@example.com', 'Licence', 'L1', 'GL');

-- =========================
-- Étudiants : Génie civil (GC)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Mariam', 'Diallo', '2000-07-15', 'Conakry', 'F', 'Quartier Dixinn', 'Conakry', 'Guinée', '+22462000111', 'mariam.diallo.gc@example.com', 'Licence', 'L2', 'GC'),
('Kwame', 'Boateng', '1998-09-10', 'Kumasi', 'M', 'Rue Ashanti', 'Kumasi', 'Ghana', '+23355000112', 'kwame.boateng.gc@example.com', 'Licence', 'L3', 'GC'),
('Sarah', 'Ngoma', '2001-01-25', 'Kinshasa', 'F', 'Avenue Lumumba', 'Kinshasa', 'RDC', '+24381000113', 'sarah.ngoma.gc@example.com', 'Licence', 'L1', 'GC'),
('Yao', 'Kouassi', '1999-04-09', 'Abidjan', 'M', 'Rue Treichville', 'Abidjan', 'Côte d’Ivoire', '+22507000114', 'yao.kouassi.gc@example.com', 'Master', 'M1', 'GC');

-- =========================
-- Étudiants : Electrotechnique (ELT)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('David', 'Okoro', '1999-04-18', 'Lagos', 'M', 'Victoria Island', 'Lagos', 'Nigeria', '+23481000121', 'david.okoro.elt@example.com', 'Licence', 'L3', 'ELT'),
('Fatou', 'Sow', '2000-08-30', 'Dakar', 'F', 'Quartier Médina', 'Dakar', 'Sénégal', '+22177000122', 'fatou.sow.elt@example.com', 'Licence', 'L2', 'ELT'),
('Pierre', 'Nguyen', '2001-12-05', 'Hanoï', 'M', 'Ba Dinh', 'Hanoï', 'Vietnam', '+8490000123', 'pierre.nguyen.elt@example.com', 'Licence', 'L1', 'ELT'),
('Afi', 'Kuenyehia', '2002-03-11', 'Ho', 'F', 'Rue Market', 'Ho', 'Ghana', '+23324000124', 'afi.kuenyehia.elt@example.com', 'Licence', 'L1', 'ELT');

-- =========================
-- Étudiants : Réseaux et télécommunication (RT)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Aminata', 'Keita', '2000-02-14', 'Bamako', 'F', 'Kalaban Coura', 'Bamako', 'Mali', '+22370000131', 'aminata.keita.rt@example.com', 'Licence', 'L2', 'RT'),
('Joseph', 'Smith', '1999-06-22', 'London', 'M', 'Oxford Street', 'London', 'UK', '+4477000132', 'joseph.smith.rt@example.com', 'Master', 'M1', 'RT'),
('Ali', 'Ben Salah', '2001-09-09', 'Tunis', 'M', 'Habib Bourguiba', 'Tunis', 'Tunisie', '+21620000133', 'ali.bensalah.rt@example.com', 'Licence', 'L1', 'RT'),
('Zineb', 'El Fassi', '2002-10-03', 'Rabat', 'F', 'Agdal', 'Rabat', 'Maroc', '+21262000134', 'zineb.elfassi.rt@example.com', 'Licence', 'L1', 'RT');

-- =========================
-- Étudiants : Communication (CO)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Nadia', 'Benali', '2000-01-12', 'Casablanca', 'F', 'Maarif', 'Casablanca', 'Maroc', '+21265000141', 'nadia.benali.co@example.com', 'Licence', 'L2', 'CO'),
('Michel', 'Tchalla', '1998-10-08', 'Cotonou', 'M', 'Cadjehoun', 'Cotonou', 'Bénin', '+22997000142', 'michel.tchalla.co@example.com', 'Licence', 'L3', 'CO'),
('Akim', 'Traoré', '2001-03-29', 'Ouagadougou', 'M', 'Patte d’Oie', 'Ouagadougou', 'Burkina Faso', '+22670000143', 'akim.traore.co@example.com', 'Licence', 'L1', 'CO'),
('Grace', 'Amabovi', '2002-05-25', 'Lomé', 'F', 'Tokoin', 'Lomé', 'Togo', '+22890000144', 'grace.amabovi.co@example.com', 'Licence', 'L1', 'CO');

-- =========================
-- Étudiants : Commerce international (CI)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Hassan', 'Alami', '1999-02-20', 'Fès', 'M', 'Ville Nouvelle', 'Fès', 'Maroc', '+21268000151', 'hassan.alami.ci@example.com', 'Licence', 'L3', 'CI'),
('Irene', 'Owusu', '2000-07-07', 'Tema', 'F', 'Community 1', 'Tema', 'Ghana', '+23354000152', 'irene.owusu.ci@example.com', 'Licence', 'L2', 'CI'),
('Basile', 'Dossou', '2001-11-11', 'Porto-Novo', 'M', 'Ouando', 'Porto-Novo', 'Bénin', '+22961000153', 'basile.dossou.ci@example.com', 'Licence', 'L1', 'CI'),
('Elom', 'Agbo', '2002-06-16', 'Lomé', 'M', 'Agoe', 'Lomé', 'Togo', '+22890000154', 'elom.agbo.ci@example.com', 'Licence', 'L1', 'CI');

-- =========================
-- Étudiants : Comptabilité et finance (CF)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Patricia', 'Kouadio', '1999-09-14', 'Bouaké', 'F', 'Belleville', 'Bouaké', 'Côte d’Ivoire', '+22507000161', 'patricia.kouadio.cf@example.com', 'Licence', 'L3', 'CF'),
('Samuel', 'Adebayo', '2000-12-03', 'Ibadan', 'M', 'Ring Road', 'Ibadan', 'Nigeria', '+23481000162', 'samuel.adebayo.cf@example.com', 'Licence', 'L2', 'CF'),
('Yves', 'Akakpo', '2001-04-27', 'Lomé', 'M', 'Bè', 'Lomé', 'Togo', '+22890000163', 'yves.akakpo.cf@example.com', 'Licence', 'L1', 'CF'),
('Aicha', 'Bamba', '2002-08-09', 'Abidjan', 'F', 'Cocody', 'Abidjan', 'Côte d’Ivoire', '+22507000164', 'aicha.bamba.cf@example.com', 'Licence', 'L1', 'CF');

-- =========================
-- Étudiants : Finance et banque (FB)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Nasser', 'Bouh', '1999-10-02', 'Nouakchott', 'M', 'Tevragh Zeina', 'Nouakchott', 'Mauritanie', '+22236000171', 'nasser.bouh.fb@example.com', 'Licence', 'L3', 'FB'),
('Linda', 'Gomez', '2000-05-05', 'Madrid', 'F', 'Lavapiés', 'Madrid', 'Espagne', '+3491000172', 'linda.gomez.fb@example.com', 'Licence', 'L2', 'FB'),
('Kodjo', 'Atayi', '2001-02-18', 'Lomé', 'M', 'Adidogomé', 'Lomé', 'Togo', '+22890000173', 'kodjo.atayi.fb@example.com', 'Licence', 'L1', 'FB'),
('Maya', 'Seka', '2002-07-21', 'Abidjan', 'F', 'Plateau', 'Abidjan', 'Côte d’Ivoire', '+22507000174', 'maya.seka.fb@example.com', 'Licence', 'L1', 'FB');

-- =========================
-- Étudiants : Droit privé (DP)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Rachid', 'Benkacem', '1998-12-12', 'Alger', 'M', 'El Biar', 'Alger', 'Algérie', '+21355000181', 'rachid.benkacem.dp@example.com', 'Licence', 'L3', 'DP'),
('Salma', 'Cherkaoui', '2000-03-31', 'Marrakech', 'F', 'Gueliz', 'Marrakech', 'Maroc', '+21266000182', 'salma.cherkaoui.dp@example.com', 'Licence', 'L2', 'DP'),
('Bako', 'Traoré', '2001-06-06', 'Bobo-Dioulasso', 'M', 'Sarfalao', 'Bobo-Dioulasso', 'Burkina Faso', '+22670000183', 'bako.traore.dp@example.com', 'Licence', 'L1', 'DP'),
('Mireille', 'Ayité', '2002-09-09', 'Lomé', 'F', 'Amadahomé', 'Lomé', 'Togo', '+22890000184', 'mireille.ayite.dp@example.com', 'Licence', 'L1', 'DP');

-- =========================
-- Étudiants : Gestion logistique et transport (LT)
-- =========================
INSERT INTO students (stu_firstname, stu_lastname, stu_birthday, stu_birthplace, stu_gender, stu_address, stu_city, stu_country, stu_phone_number, stu_email, stu_degree, stu_level, stream_code)
VALUES
('Jonas', 'Mabika', '1999-01-19', 'Brazzaville', 'M', 'Plateaux', 'Brazzaville', 'Congo', '+24206000191', 'jonas.mabika.lt@example.com', 'Licence', 'L3', 'LT'),
('Djamila', 'Brahimi', '2000-04-04', 'Oran', 'F', 'Akid Lotfi', 'Oran', 'Algérie', '+21356000192', 'djamila.brahimi.lt@example.com', 'Licence', 'L2', 'LT'),
('Prosper', 'Azanku', '2001-07-07', 'Tema', 'M', 'Community 7', 'Tema', 'Ghana', '+23324000193', 'prosper.azanku.lt@example.com', 'Licence', 'L1', 'LT'),
('Sena', 'Kpodo', '2002-10-10', 'Lomé', 'F', 'Agoe-Assiyéyé', 'Lomé', 'Togo', '+22890000194', 'sena.kpodo.lt@example.com', 'Licence', 'L1', 'LT');

COMMIT;