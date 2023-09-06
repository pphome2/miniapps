<?php

 #
 # Raktár
 #
 # info: main folder copyright file
 #
 #

# rendszer
$L_SITENAME="Raktár";
$L_ROOTHOME="Intranet";
$L_SITEHOME="Raktárkészlet";

$R_AVE="Jó munkát";

# applikáció
$R_MENU=array("Beszállítók","Cikk kategória","Cikktörzs","Raktárak","Költséghely, felhasználó","Bevételezés","Kiadás","Lekérdezések","Leltár","Keresés");

$R_SEARCH_TEXT="Tárolt elem keresése";
$R_PRIVACYTITLE="Adatvédelmi tájékoztató";

$R_OK="rendben";
$R_ERROR="hiba történt";
$R_SAVE="Mentés";
$R_SEARCH="Keresés lapon belül...";

$R_GO=">>>";
$R_PAGE_RIGHT=">";
$R_PAGE_LEFT="<";
$R_BACK="Vissza";

$R_LISTS=array("Bevételezések",
				"Raktári kiadások",
				"Raktárkészlet",
				"Havi kiadási mennyiségek",
				"Havi kiadás költséghelyként",
				"Termékek minimum készlet alatt",
				"Leltári korrekciók"
				);
$R_DOWNLOAD="Letöltés";
$R_DOWNLOADTEXT="A letöltés előkészítve.";

$R_TOOMANYROW="Túl sok találat, pontosítsa a keresést.";
$R_NOITEM="Nincs találat, pontosítsa a keresést.";
$R_DB="db cikk a raktárban";

$R_PARTNER_TITLE_NEW="Új partner";
$R_PARTNER_TITLE_CHANGE="Partneradatok módosítása";
$R_PARTNER_TITLE_DEL="Partneradatok törlése";
$R_PARTNER_TABLE_TITLE=array("Név","Város","E-mail","Adószám","Számlaszám","Töröl / Javít");
$R_NEW_PARTNER="+";
$R_WORK_PARTNER=">>>";
$R_DEL_PARTNER="Törlés";
$R_PARTNER_FIELDS=array(
					"ID",
					"Név",
					"Ország",
					"Irányítószám",
					"Város",
					"Cím 1",
					"Cím 2",
					"E-mail",
					"Adószám",
					"Számlaszám"
			);
$R_PARTNER_NEWITEMS="Új bevételezés a partnertől";
$R_PARTNER_SEARCH="Keresés név alapján";

$R_CAT_TITLE_NEW="Új cikk kategória";
$R_CAT_TITLE_CHANGE="Kategória módosítása";
$R_CAT_TITLE_DEL="Kategória törlése";
$R_CAT_TABLE_TITLE=array("Kód","Név","Töröl / Javít");
$R_NEW_CAT="+";
$R_WORK_CAT=">>>";
$R_DEL_CAT="Törlés";
$R_CAT_FIELDS=array("ID","Kód","Név");

$R_INAME_TITLE_NEW="Új cikk";
$R_INAME_TITLE_CHANGE="Cikkadatok módosítása";
$R_INAME_TITLE_DEL="Cikk törlése";
$R_INAME_TABLE_TITLE=array("Cikkszám","Kategória","Név","Vonalkód","Minimum készlet","Töröl / Javít");
$R_NEW_INAME="+";
$R_WORK_INAME=">>>";
$R_DEL_INAME="Törlés";
$R_INAME_FIELDS=array("ID","Cikkszám","Kategória","Név","Vonalkód","Menniségi egység","Minimum készlet");
$R_INAME_SEARCH="Keresés cikkszám, név, vonalkór alapján";

$R_RAK_TITLE_NEW="Új raktár";
$R_RAK_TITLE_CHANGE="Raktár módosítása";
$R_RAK_TITLE_DEL="Raktár törlése";
$R_RAK_TABLE_TITLE=array("Név","Töröl / Javít");
$R_NEW_RAK="+";
$R_WORK_RAK=">>>";
$R_DEL_RAK="Törlés";
$R_RAK_FIELDS=array("ID","Név");
$R_RAK_SEARCH="Keresés raktárnév alapján";

$R_KLT_TITLE_NEW="Új költséghely/felhasználó";
$R_KLT_TITLE_CHANGE="Költséghely/felhasználó módosítása";
$R_KLT_TITLE_DEL="Költséghely/felhasználó törlése";
$R_KLT_TABLE_TITLE=array("Név","Töröl / Javít");
$R_NEW_KLT="+";
$R_WORK_KLT=">>>";
$R_DEL_KLT="Törlés";
$R_KLT_FIELDS=array("ID","Név");

$R_SELECT="Kiválaszt";
$R_I_TEXT="Kiválasztott cikk: ";
$R_P_TEXT="Kiválasztott beszállító: ";
$R_R_TEXT="Kiválasztott raktár: ";
$R_S_TEXT="A raktárban található mennyiség";

$R_IN_STAGE=array("Első lépés: beszállító kiválasztása.","Második lépés: cikk kiválasztása.","Harmadik lépés: cikkadatok megadása.");
$R_IN_FIELDS=array("ID","Dátum","Beszállító","Cikk","Mennyiség","Egységár","Érték","Bizonylat","Megjegyzés","Megrendelő","Raktár","Elhelyezés");
$R_IN_TITLE_NEW="Új cikk bevételezése";
$R_IN_NEWITEM="Új cikk a beszállítótól";
$R_IN_RESTART="Bevételezés újrakezdése";
$R_IN_TABLE_TITLE=array("Dátum","Beszállító","Cikk","Mennyiség","Egységár","Érték","Bizonylat","Megjegyzés","Megrendelő","Raktár","Felhasználó");

$R_STR_TITLE="Raktár";
$R_STR_TABLE_TITLE=array("Kategória","Cikkszám","Cikk","Mennyiség","Mennyiségi egység","Egységár","Utolsó bevétel","Utolsó kiadás","Megjegyzés");
$R_STR_TABLE_TITLE2=array("Kategória","Cikkszám","Cikk","Mennyiség","Mennyiségi egység","Egységár","Összérték","Utolsó bevétel","Utolsó kiadás","Megjegyzés");

$R_OUT_STAGE=array("Első lépés: raktár kiválasztása.","Második lépés: cikk kiválasztása.","Harmadik lépés: cikkadatok megadása.");
$R_OUT_FIELDS=array("ID","Dátum","Raktár","Cikk","Mennyiség","Bizonylat","Megjegyzés","Költséghely");
$R_OUT_FIELDS2=array("ID","Dátum","Cikk","Mennyiség","Bizonylat","Költséghely","Megjegyzés","Raktár","Felhasználó");
$R_OUT_TITLE_NEW="Cikk kiadása";
$R_OUT_NEWITEM="Cikk kiadása a raktárból";
$R_OUT_RESTART="Kiadás újrakezdése";
$R_OUT_NOITEM="nincs még cikk a raktárban";
$R_OUT_TABLE_TITLE=array("Dátum","Cikk","Mennyiség","Bizonylat","Költséghely","Megjegyzés","Raktár","Felhasználó");
$R_OUT_TABLE_TITLE_MOUNTH=array("Dátum","Cikk","Egységár","Mennyiség","Bizonylat","Költséghely","Megjegyzés","Raktár");
$R_MIN_TEXT="Készleten kevesebb mint a megadott minimum.";
$R_MIN="minimum készlet";
$R_REAL="raktárban készlet";

$R_SEARCH_TITLE="Cikk keresés";
$R_SEARCH_LABEL=array("Cikk neve vagy cikkszáma vagy vonalkódja");
$R_SEARCH_BUTTON="Keresés";
$R_SEARCH_TABLE_TITLE=array("Cikkszám","Kategória","Név","Vonalkód","Raktár","Mennyiség","Megjegyzés");

$R_LELTITLE="Leltár - készlet korrekció";
$R_LEL_TABLE_TITLE=array("Kategória","Cikkszám","Cikk","Mennyiség","Mennyiségi egység","Egységár","Mennyiségi eltérés","Tárol");
$R_LELLIST_TABLE_TITLE=array("Dátum","Kategória","Cikkszám","Cikk","Korrekció","Felhasználó");

?>
