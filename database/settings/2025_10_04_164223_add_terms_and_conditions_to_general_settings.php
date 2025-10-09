<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $defaultTerms = [
            "This quotation is valid for 30 days from the date of issue.",
            "Prices are subject to change without prior notice.",
            "Payment terms: Net 30 days.",
            "Delivery will be made within 7-14 business days after order confirmation.",
            "All disputes are subject to jurisdiction of local courts."
        ];

        $this->migrator->add('general.terms_and_conditions', $defaultTerms);
    }

    public function down(): void
    {
        $this->migrator->delete('general.terms_and_conditions');
    }
};
