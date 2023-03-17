# sql install

create database if not exists demo;

use demo;

create table if not exists ik_partner (
    id bigint auto_increment primary key,
    nev varchar(80) charset utf8,
    orsz varchar(80) charset utf8,
    irsz varchar(10) charset utf8,
    varo varchar(80) charset utf8,
    cim1 varchar(80) charset utf8,
    cim2 varchar(80) charset utf8,
    mail varchar(80) charset utf8,
    asz varchar(15) charset utf8,
    megj varchar(128) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

create table if not exists ik_cat (
    id bigint auto_increment primary key,
    kod varchar(20) charset utf8,
    nev varchar(80) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

create table if not exists ik_doc (
    id bigint auto_increment primary key,
    sorsz varchar(20) charset utf8,
    datum varchar(20) charset utf8,
    szsz varchar(40) charset utf8,
    partner bigint,
    ossz bigint,
    pnem varchar(10) charset utf8,
    kat bigint,
    kiall varchar(20) charset utf8,
    fhat varchar(20) charset utf8,
    fiz varchar(20) charset utf8,
    telep varchar(40) charset utf8,
    bank varchar(40) charset utf8,
    megj varchar(128) charset utf8,
    fajl varchar(60) charset utf8,
    key name (sorsz(20))
) engine=InnoDB default charset latin1;


create table if not exists ik_param (
    id bigint auto_increment primary key,
    kod varchar(20) charset utf8,
    key name (kod(20))
) engine=InnoDB default charset latin1;
