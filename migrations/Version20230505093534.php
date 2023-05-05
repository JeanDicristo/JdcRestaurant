<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505093534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil_user_reservation DROP CONSTRAINT fk_f090bdd8227a1cc4');
        $this->addSql('ALTER TABLE profil_user_reservation DROP CONSTRAINT fk_f090bdd8b83297e7');
        $this->addSql('DROP TABLE profil_user_reservation');
        $this->addSql('ALTER TABLE reservation ADD max_guest INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE profil_user_reservation (profil_user_id INT NOT NULL, reservation_id INT NOT NULL, PRIMARY KEY(profil_user_id, reservation_id))');
        $this->addSql('CREATE INDEX idx_f090bdd8b83297e7 ON profil_user_reservation (reservation_id)');
        $this->addSql('CREATE INDEX idx_f090bdd8227a1cc4 ON profil_user_reservation (profil_user_id)');
        $this->addSql('ALTER TABLE profil_user_reservation ADD CONSTRAINT fk_f090bdd8227a1cc4 FOREIGN KEY (profil_user_id) REFERENCES profil_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profil_user_reservation ADD CONSTRAINT fk_f090bdd8b83297e7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation DROP max_guest');
    }
}
