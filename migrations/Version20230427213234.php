<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427213234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil_user_reservation (profil_user_id INT NOT NULL, reservation_id INT NOT NULL, PRIMARY KEY(profil_user_id, reservation_id))');
        $this->addSql('CREATE INDEX IDX_F090BDD8227A1CC4 ON profil_user_reservation (profil_user_id)');
        $this->addSql('CREATE INDEX IDX_F090BDD8B83297E7 ON profil_user_reservation (reservation_id)');
        $this->addSql('ALTER TABLE profil_user_reservation ADD CONSTRAINT FK_F090BDD8227A1CC4 FOREIGN KEY (profil_user_id) REFERENCES profil_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profil_user_reservation ADD CONSTRAINT FK_F090BDD8B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE profil_user_reservation DROP CONSTRAINT FK_F090BDD8227A1CC4');
        $this->addSql('ALTER TABLE profil_user_reservation DROP CONSTRAINT FK_F090BDD8B83297E7');
        $this->addSql('DROP TABLE profil_user_reservation');
    }
}
