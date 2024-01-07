<?php 
namespace App\Enums;

enum Role {
    case ADMIN;
    case USER;
    case GUEST;
    case CUSTOMER;
    case CODER;
    case ANALYZER;
    case DESIGNER;
    case TESTER;

    public static function getLabel(Role $role): string {
        return match ($role) {
            self::ADMIN => 'Administrator',
            self::USER => 'User',
            self::CUSTOMER => 'Customer',
            self::CODER => 'Coder',
            self::ANALYZER => 'Analyzer',
            self::DESIGNER => 'Designer',
            self::GUEST => 'Guest',
            self::TESTER => 'Tester'
        };
    }

    public static function getValues(): array {
        $values = ['Administrator', 'Customer', 'Coder' , 'Analyzer']; 
        
        
        return $values;
    }
}