BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "produits" (
	"np"	INTEGER,
	"nomp"	VARCHAR(20),
	"tome"	INTEGER,
	"prix"	INTEGER,
	"imagep"	varchar(50),
	PRIMARY KEY("np")
);
CREATE TABLE IF NOT EXISTS "clients" (
	"nc"	SERIAL,
	"nomc"	VARCHAR(20),
	"ville"	VARCHAR(20),
	PRIMARY KEY("nc")
);
CREATE TABLE IF NOT EXISTS "vendeurs" (
	"nr"	SERIAL,
	"nomr"	VARCHAR(20),
	"ville"	VARCHAR(20),
	PRIMARY KEY("nr")
);
CREATE TABLE IF NOT EXISTS "ventes" (
	"nr"	INTEGER,
	"np"	INTEGER,
	"nc"	INTEGER,
	"qt"	INTEGER,
	CONSTRAINT "fk_np" FOREIGN KEY("np") REFERENCES "produits"("np") ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY("nr") REFERENCES "vendeurs"("nr"),
	CONSTRAINT "fk_nc" FOREIGN KEY("nc") REFERENCES "clients"("nc") ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT "fk_nr" FOREIGN KEY("nr") REFERENCES "vendeurs"("nr") ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY("np") REFERENCES "produits"("np"),
	FOREIGN KEY("nc") REFERENCES "clients"("nc"),
	PRIMARY KEY("nr","np","nc")
);
CREATE TABLE IF NOT EXISTS "comptes" (
	"login"	VARCHAR NOT NULL DEFAULT (null),
	"password"	VARCHAR DEFAULT (null),
	"statut"	VARCHAR NOT NULL DEFAULT 'utilisateur',
	"nc"	INTEGER DEFAULT (null),
	"nr"	INTEGER DEFAULT NULL,
	CONSTRAINT "FK_1" FOREIGN KEY("nc") REFERENCES "clients"("nc"),
	CONSTRAINT "FK_2" FOREIGN KEY("nr") REFERENCES "vendeurs"("nr"),
	PRIMARY KEY("login")
);
INSERT INTO "clients" ("nomc", "ville") VALUES ('Thomas','Bordeaux');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Alice','Morlaix');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Margot','Paris');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Lola','Lannion');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Jean','Perros');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Titi','Paris');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Tutu','Toulouse');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Michem','Arcachon');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Pierre','Caillou');
INSERT INTO "clients" ("nomc", "ville") VALUES ('Claire','Nice');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Stephane','Lyon');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Philippe','Brest');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Tom','Paris');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Antoine','Lannion');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Bruno','Toulouse');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Jacob','villejuif');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Marie','Ajaccio');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Yseult','Sept');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Felix','Plurien');
INSERT INTO "vendeurs" ("nomr", "ville") VALUES ('Arthur','Orléans');
INSERT INTO "produits" VALUES (1,'One Piece',63,10,'images/op.jpg');
INSERT INTO "produits" VALUES (2,'Naruto',43,9,'images/naruto.jpg');
INSERT INTO "produits" VALUES (3,'Dragon Ball',18,11,'images/db.jpg');
INSERT INTO "produits" VALUES (4,'Fairy Tail',23,6,'images/ft.png');
INSERT INTO "produits" VALUES (5,'Hunter X Hunter',37,7,'images/hxh.jpg');
INSERT INTO "produits" VALUES (6,'Evangelion',12,3,'images/evangelion.jpg');
INSERT INTO "produits" VALUES (7,'My Hero Academia',34,5,'images/mha.jpg');
INSERT INTO "produits" VALUES (8,'L''attaque des Titans',8,8,'images/snk.jpg');
INSERT INTO "produits" VALUES (9,'Jujutsu Kaisen',11,4,'images/jjk.jpg');
INSERT INTO "produits" VALUES (10,'Demon Slayer',22,12,'images/ds.jpg');
INSERT INTO "comptes" VALUES ('Admin@root.fr','lannion','admin',NULL,NULL);
INSERT INTO "comptes" VALUES ('Alice@Morlaix.fr','AuPays','non-admin',2,NULL);
INSERT INTO "comptes" VALUES ('Thomas@Bordeaux.fr','Arcachon','non-admin',1,NULL);
INSERT INTO "comptes" VALUES ('Stephane@Lyon.fr','Lion','non-admin',NULL,1);
INSERT INTO "comptes" VALUES ('Philippe@Brest.fr','Vauban','non-admin',NULL,2);
INSERT INTO "comptes" VALUES ('Jean@Perros.fr','Granit','non-admin',5,NULL);
INSERT INTO "comptes" VALUES ('Titi@Paris.fr','Banlieu','non-admin',6,NULL);
INSERT INTO "comptes" VALUES ('Jacob@villejuif.fr','Rabbi','non-admin',NULL,6);
INSERT INTO "comptes" VALUES ('Felix@Plurien.fr','plutout','non-admin',NULL,9);
INSERT INTO "comptes" VALUES ('co-admin@root.fr','unpeumieuxquelannion','admin',NULL,NULL);
INSERT INTO "ventes" VALUES (1,1,1,1);
INSERT INTO "ventes" VALUES (1,1,2,1);
INSERT INTO "ventes" VALUES (2,2,1,1);
INSERT INTO "ventes" VALUES (6,3,6,30);
INSERT INTO "ventes" VALUES (1,3,2,50);
INSERT INTO "ventes" VALUES (6,1,5,20);
INSERT INTO "ventes" VALUES (6,4,1,18);
INSERT INTO "ventes" VALUES (2,4,6,50);
INSERT INTO "ventes" VALUES (9,1,1,5);
INSERT INTO "ventes" VALUES (9,4,5,6);
COMMIT;
