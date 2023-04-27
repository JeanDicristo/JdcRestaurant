<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427213127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE hourly_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE hourly (id INT NOT NULL, day VARCHAR(11) NOT NULL, opening_time VARCHAR(255) NOT NULL, closed BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN hourly.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN hourly.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE profil_user_allergy (profil_user_id INT NOT NULL, allergy_id INT NOT NULL, PRIMARY KEY(profil_user_id, allergy_id))');
        $this->addSql('CREATE INDEX IDX_E53A2336227A1CC4 ON profil_user_allergy (profil_user_id)');
        $this->addSql('CREATE INDEX IDX_E53A2336DBFD579D ON profil_user_allergy (allergy_id)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, name VARCHAR(100) NOT NULL, guest INT NOT NULL, date DATE NOT NULL, hour TIME(0) WITHOUT TIME ZONE NOT NULL, commentaire TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN reservation.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reservation.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE profil_user_allergy ADD CONSTRAINT FK_E53A2336227A1CC4 FOREIGN KEY (profil_user_id) REFERENCES profil_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profil_user_allergy ADD CONSTRAINT FK_E53A2336DBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profil_user ADD guest INT NOT NULL');
        $this->addSql('ALTER TABLE profil_user ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE profil_user ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('COMMENT ON COLUMN profil_user.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN profil_user.updated_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE hourly_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('ALTER TABLE profil_user_allergy DROP CONSTRAINT FK_E53A2336227A1CC4');
        $this->addSql('ALTER TABLE profil_user_allergy DROP CONSTRAINT FK_E53A2336DBFD579D');
        $this->addSql('DROP TABLE hourly');
        $this->addSql('DROP TABLE profil_user_allergy');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('ALTER TABLE profil_user DROP guest');
        $this->addSql('ALTER TABLE profil_user DROP created_at');
        $this->addSql('ALTER TABLE profil_user DROP updated_at');
    }
}
