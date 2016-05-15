CREATE TABLE Users ( mail varchar(50) primary key,mdp varchar(50), nom varchar(50), prenom varchar(50),nbQuizzDelete MEDIUMINT);
CREATE TABLE Follow ( mail1 varchar(50),mail2 varchar(50), CONSTRAINT fk_mail1_Users FOREIGN KEY (mail1) REFERENCES Users(mail),CONSTRAINT fk_mail2_Users FOREIGN KEY (mail2) REFERENCES Users(mail),
                                                           CONSTRAINT pk_mail1_mail2 PRIMARY KEY(mail1,mail2));
CREATE TABLE Quizz (idQuizz MEDIUMINT AUTO_INCREMENT PRIMARY KEY, nom varchar(100), description varchar(500), mail varchar(50), CONSTRAINT fk_mail_quizz FOREIGN KEY (mail) REFERENCES Users(mail));
              ALTER TABLE quizz ADD CONSTRAINT unique_quizz_nom_mail UNIQUE (
              mail,
              nom
            );
              ALTER TABLE quizz ADD COLUMN DATE INT;
CREATE TABLE Question (texte varchar(255),idQuizz MEDIUMINT, CONSTRAINT pk_texte_idQuizz_Question PRIMARY KEY(texte,idQuizz),
                                                             CONSTRAINT fk_idQuizz_question FOREIGN KEY (idQuizz) REFERENCES Quizz(idQuizz));
CREATE TABLE Reponse (mail varchar(50),texte varchar(255),idQuizz mediumint,reponse varchar(500), CONSTRAINT pk_texte_mail_idQuizz_Reponse PRIMARY KEY(mail,texte,idQuizz),
                                                                                                 CONSTRAINT fk_idQuizz_Reponse FOREIGN KEY (idQuizz) REFERENCES Question(idQuizz),
                                                                                                 CONSTRAINT fk_mail_Reponse FOREIGN KEY (mail) REFERENCES Users(mail),
                                                                                                 CONSTRAINT fk_texte_Reponse FOREIGN KEY (texte) REFERENCES Question(texte));
CREATE trigger triggerDeleteQuizz AFTER DELETE ON quizz FOR each ROW UPDATE users SET nbQuizzDelete = nbQuizzDelete +1 WHERE users.mail = OLD.mail;
CREATE OR REPLACE trigger filtre_obscenite before
INSERT ON users
FOR each
ROW BEGIN IF( new.nom LIKE  "%bite%"
OR new.nom LIKE  "%MacIsTheBest%"
OR new.prenom LIKE  "%bite%"
OR new.prenom LIKE  "%MacIsTheBest%" )
THEN SIGNAL sqlstate '45000';

END IF ;

END
