Drop database if exists bdd_proc_heritage;
Create database if not exists bdd_proc_heritage;
Use bdd_proc_heritage;

Drop table if exists personne;
Create table personne (
	idpers int(3) not null auto_increment,
	nom varchar(50),
	prenom varchar(50),
	email varchar(50),
	mdp varchar(50),
	primary key (idpers)
) ENGINE=InnoDB, CHARSET=utf8;

Drop table if exists technicien;
Create table technicien (
	qualification varchar(50),
	idpers int(3) not null,
	primary key (idpers),
	foreign key (idpers) references personne (idpers)
	on update cascade
	on delete cascade
) ENGINE=InnoDB, CHARSET=utf8;

Drop table if exists client;
Create table if not exists client (
	adresse varchar(50),
	idpers int(3) not null,
	primary key (idpers),
	foreign key (idpers) references personne (idpers)
	on update cascade
	on delete cascade
) ENGINE=InnoDB, CHARSET=utf8;

show tables;

Drop procedure if exists insertTechnicien;
Delimiter //
Create procedure insertTechnicien(in p_nom varchar(50), in p_prenom varchar(50), in p_email varchar(50), in p_mdp varchar(50), in p_qualification varchar(50))
Begin
	declare p_idpers int(3);
	# insérer dans la table personne 
	insert into personne values (null, p_nom, p_prenom, p_email, p_mdp);
	select idpers into p_idpers
	from personne
	where email = p_email and mdp = p_mdp;
	insert into technicien values (p_qualification, p_idpers);
End //
Delimiter ;

Drop procedure if exists insertClient;
Delimiter //
Create procedure insertClient(in p_nom varchar(50), in p_prenom varchar(50), in p_email varchar(50), in p_mdp varchar(50), in p_adresse varchar(50))
Begin
	declare p_idpers int(3);
	# insérer dans la table personne 
	insert into personne values (null, p_nom, p_prenom, p_email, p_mdp);
	select idpers into p_idpers
	from personne
	where email = p_email and mdp = p_mdp;
	insert into client values (p_adresse, p_idpers);
End //
Delimiter ;

Drop procedure if exists deleteTechnicien;
Delimiter //
Create procedure deleteTechnicien(in p_idpers int(3))
Begin
	# Suppression dans la table technicien
	delete from technicien where idpers = p_idpers;
	# Suppression dans la table personne
	delete from personne where idpers = p_idpers;
End //
Delimiter ;

Drop procedure if exists deleteClient;
Delimiter //
Create procedure deleteClient(in p_idpers int(3))
Begin
	# Suppression dans la table client
	delete from client where idpers = p_idpers;
	# Suppression dans la table personne
	delete from personne where idpers = p_idpers;
End //
Delimiter ;
