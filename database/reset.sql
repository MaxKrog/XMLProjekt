DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS posts CASCADE;
DROP TABLE IF EXISTS tags CASCADE;
DROP TABLE IF EXISTS post_tags CASCADE;


CREATE TABLE users (
	username varchar(10),
	password text,
	role text,
	Constraint users_pkey Primary Key (username)
);


CREATE TABLE posts (
	post_id integer NOT NULL AUTO_INCREMENT,
	image text,
	title text,
	caption text,
	date datetime NOT NULL DEFAULT NOW(),
	lat double precision,
	lng double precision,
	username varchar(10) references users(username),
	Constraint sports_pkey Primary Key (post_id)
);

CREATE TABLE tags (
	tag varchar(20),
	Constraint tags_pkey Primary Key(tag)
);

CREATE TABLE post_tags (
	post_id integer references posts(post_id),
	tag varchar(20) references tags(tag),
	Constraint post_tags_pkey Primary Key(post_id, tag)
);

INSERT INTO users
VALUES ('mkrog', 'mkrog', 'admin');

INSERT INTO users
VALUES ('jthorel', 'jthorel', 'admin');

INSERT INTO posts
VALUES (
	1, 
	'http://ett.jpg',
	'Första posten ever!!',
	'En beskrivning av första posten ever!!',
	'',
	59.329323,
	18.068581,
	'mkrog'
);

INSERT INTO posts
VALUES (
	2, 
	'http://tva.jpg',
	'Andra posten ever!!',
	'En beskrivning av andra posten ever!!',
	'',
	59.329323,
	18.068581,
	'mkrog'
);

INSERT INTO tags
VALUES("Katastrof");

INSERT INTO tags
VALUES("Vänsterpack");

INSERT INTO post_tags
VALUES(
	1,
	"Katastrof"
);

INSERT INTO post_tags
VALUES(
	2,
	"Vänsterpack"
);


