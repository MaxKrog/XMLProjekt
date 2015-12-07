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
	lat FLOAT(9,6),
	lng FLOAT(9,6),
	username varchar(10) references users(username),
	createdAt DATETIME,
	Constraint posts_pkey Primary Key (post_id)
);

CREATE TABLE tags (
	tag varchar(20),
	Constraint tags_pkey Primary Key(tag)
);

CREATE TABLE post_tags (
	post_id integer NOT NULL references posts(post_id),
	tag varchar(20) NOT NULL references tags(tag),
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
	59.000000,
	18.000000,
	'mkrog',
	'2015-11-30 19:28:30'
);

INSERT INTO posts
VALUES (
	2, 
	'http://tva.jpg',
	'Andra posten ever!!',
	'En beskrivning av andra posten ever!!',
	59.200000,
	18.200000,
	'mkrog',
	'2015-11-30 19:28:40'
);

INSERT INTO tags
VALUES("Murder");

INSERT INTO tags
VALUES("Animals");

INSERT INTO tags
VALUES("Food");

INSERT INTO tags
VALUES("Trees");

INSERT INTO tags
VALUES("Nature");

INSERT INTO tags
VALUES("Nofilter");

INSERT INTO tags
VALUES("Reality");

INSERT INTO tags
VALUES("Crimescene");

INSERT INTO tags
VALUES("Police");

INSERT INTO tags
VALUES("Riot");

INSERT INTO post_tags
VALUES(
	1,
	"Murder"
);

INSERT INTO post_tags
VALUES(
	2,
	"Animals"
);
