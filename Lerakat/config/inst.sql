# sql install

create database if not exists demo;

use demo;

create table if not exists r_partner (
    id bigint auto_increment primary key,
    nev varchar(80) charset utf8,
    orsz varchar(80) charset utf8,
    irsz varchar(10) charset utf8,
    varo varchar(80) charset utf8,
    cim1 varchar(80) charset utf8,
    cim2 varchar(80) charset utf8,
    mail varchar(80) charset utf8,
    asz varchar(15) charset utf8,
    szsz varchar(40) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

create table if not exists r_kat (
    id bigint auto_increment primary key,
    kod varchar(20) charset utf8,
    nev varchar(80) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

create table if not exists r_cikk (
    id bigint auto_increment primary key,
    csz varchar(40) charset utf8,
    kat bigint,
    nev varchar(80) charset utf8,
    vkod varchar(40) charset utf8,
    me varchar(20) charset utf8,
    key name (csz(20))
) engine=InnoDB default charset latin1;

create table if not exists r_param (
    id bigint auto_increment primary key,
    nev varchar(20) charset utf8,
    ertek varchar(40) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

create table if not exists r_raktar (
    id bigint auto_increment primary key,
    nev varchar(40) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

create table if not exists r_kolt (
    id bigint auto_increment primary key,
    nev varchar(40) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

create table if not exists r_bev (
    id bigint auto_increment primary key,
    dat varchar(20) charset utf8,
    besz bigint,
    cikk bigint,
    menny bigint,
    ear int,
    ertek int,
    biz varchar(80) charset utf8,
    megj varchar(120) charset utf8,
    megr varchar(40) charset utf8,
    rakt bigint,
    key name (dat(20))
) engine=InnoDB default charset latin1;

create table if not exists r_keszlet (
    id bigint auto_increment primary key,
    cikk bigint,
    rakt bigint,
    menny bigint,
    ukid varchar(20) charset utf8,
    ubev varchar(20) charset utf8,
    ear int,
    key name (cikk)
) engine=InnoDB default charset latin1;

create table if not exists r_kiad (
    id bigint auto_increment primary key,
    dat varchar(20) charset utf8,
    cikk bigint,
    menny bigint,
    biz varchar(80) charset utf8,
    klt bigint,
    megj varchar(120) charset utf8,
    rakt bigint,
    key name (dat(20))
) engine=InnoDB default charset latin1;
