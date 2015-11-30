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
	post_id integer NOT NULL,
	image text,
	title text,
	caption text,
	date date,
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



