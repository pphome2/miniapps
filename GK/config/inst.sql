# sql install

create database if not exists derula;

use derula;

create table if not exists gk_data (
    id bigint auto_increment primary key,
    model varchar(20) charset utf8,
    rsz varchar(20) charset utf8,
    tip varchar(80) charset utf8,
    gyev varchar(10) charset utf8,
    forg varchar(20) charset utf8,
    muszerv varchar(20) charset utf8,
    km int,
    tulaj varchar(40) charset utf8,
    besz varchar(20) charset utf8,
    vcsperkm int,
    vcskm int,
    vcsdat varchar(20) charset utf8,
    olajdat varchar(20) charset utf8,
    olajkm int,
    megj text charset utf8,
    felh varchar(40) charset utf8,
    key name (rsz(20))
) engine=InnoDB default charset latin1;

create table if not exists gk_param (
    id bigint auto_increment primary key,
    nev varchar(20) charset utf8,
    ertek varchar(40) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

