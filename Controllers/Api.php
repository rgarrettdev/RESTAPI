<?php
class Api extends Controller {
    public static function printMasterQuery() {
        echo (Database::query("SELECT name FROM sqlite_master where type='table'"));
    }
    public static function printScheduleQuery() {
        echo (Database::query("SELECT * FROM 'sessions'"));
    }
    public static function printScheduleSessionQuery() {
        print_r(Database::query("SELECT * FROM users"));
    }
    public static function printPresentationsQuery() {
        print_r(Database::query("SELECT * FROM users"));
    }
    public static function printPresentationsSearchQuery() {
        print_r(Database::query("SELECT * FROM users"));
    }
    public static function printPresentationsCategoryQuery() {
        print_r(Database::query("SELECT * FROM users"));
    }
}
?>