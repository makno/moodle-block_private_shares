<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License...
//
// @package    block_private_shares
// @copyright  2026 Mathias Knoll
// @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


$string['pluginname'] = 'Private Shares';
$string['private_shares'] = 'Private Freigaben';
$string['private_shares:addinstance'] = 'Einen neuen Block mit privaten Freigaben hinzufügen';
$string['private_shares:myaddinstance'] = 'Einen neuen Block mit privaten Freigaben auf meiner Moodle Seite hinzufügen';

$string['blocksettings'] = 'Zusätzliche Einstellungen';

$string['headerconfig'] = 'Konfiguration';
$string['descconfig'] = 'Zusätzliche Konfiguration';

$string['labelshowheader'] = 'Kopfbereich anzeigen ';
$string['descshowheader'] = 'Kopfbereich des Blocks anzeigen ';

$string['blocktitle'] = 'Blocktitel';
$string['blocktitle_help'] = 'Titel des Blocks';
$string['blocktitle_default'] = 'Private Freigabe';

$string['blockstring'] = 'Blockstring';
$string['blockstring_help'] = 'Beschreibender Text zu den Daten';

$string['filename'] = 'Dateiname';
$string['filename_help'] = 'Daten werden für Studierende unter diesem Namen zum Download angeboten. Wenn Sie hier nichts eingeben, wird der Inhalt der Daten als Text angezeigt. Achtung vor allzu langem Text!';

$string['csvfile'] = 'Share Konfigurationsdatei (CSV formatierter Text)';
$string['csvfile_help'] = 'Format: "benutzerkürzel,"base64 kodierter Inhalt"';

$string['error_number_fields'] = 'Fehler (Z{$a->line}): Falsche Anzahl an Feldern!';
$string['error_user_not_existing'] = 'Fehler (Z{$a->line}): {$a->username} existiert nicht!';
$string['error_no_base64'] = 'Fehler (Z{$a->line}): Kein BASE64!';
$string['error_no_usershare'] = 'Ihnen wurden keinen Daten zugewiesen! Wenden Sie sich an Ihre/n Lehrende/n!';