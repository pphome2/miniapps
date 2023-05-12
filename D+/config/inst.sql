# sql install

create database if not exists demo;

use demo;

create table if not exists d_doc (
    id bigint auto_increment primary key,
    datum varchar(20) charset utf8,
    partner varchar(120) charset utf8,
    indul varchar(20) charset utf8,
    lejar varchar(20) charset utf8,
    leiras text charset utf8,
    fajl varchar(200) charset utf8,
    key name (datum(20))
) engine=InnoDB default charset latin1;


create table if not exists d_param (
    id bigint auto_increment primary key,
    nev varchar(20) charset utf8,
    ertek varchar(20) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;
