<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220529184234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accomodation_type (id INT AUTO_INCREMENT NOT NULL, accomodation_type_name VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advertisment (id INT AUTO_INCREMENT NOT NULL, accommodation_type_id INT DEFAULT NULL, state_id INT DEFAULT NULL, rents_periodation_id INT DEFAULT NULL, owned_by_id INT DEFAULT NULL, advertisment_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, illusttration VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, availibility_date DATE NOT NULL, validity_date DATE DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, status TINYINT(1) NOT NULL, INDEX IDX_891141C78978F869 (accommodation_type_id), INDEX IDX_891141C75D83CC1 (state_id), INDEX IDX_891141C7D3042614 (rents_periodation_id), INDEX IDX_891141C75E70BCD7 (owned_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_periodation (id INT AUTO_INCREMENT NOT NULL, rent_periodation_name VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE states (id INT AUTO_INCREMENT NOT NULL, name_state VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advertisment ADD CONSTRAINT FK_891141C78978F869 FOREIGN KEY (accommodation_type_id) REFERENCES accomodation_type (id)');
        $this->addSql('ALTER TABLE advertisment ADD CONSTRAINT FK_891141C75D83CC1 FOREIGN KEY (state_id) REFERENCES states (id)');
        $this->addSql('ALTER TABLE advertisment ADD CONSTRAINT FK_891141C7D3042614 FOREIGN KEY (rents_periodation_id) REFERENCES rent_periodation (id)');
        $this->addSql('ALTER TABLE advertisment ADD CONSTRAINT FK_891141C75E70BCD7 FOREIGN KEY (owned_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE advertisment DROP FOREIGN KEY FK_891141C78978F869');
        $this->addSql('ALTER TABLE advertisment DROP FOREIGN KEY FK_891141C7D3042614');
        $this->addSql('ALTER TABLE advertisment DROP FOREIGN KEY FK_891141C75D83CC1');
        $this->addSql('DROP TABLE accomodation_type');
        $this->addSql('DROP TABLE advertisment');
        $this->addSql('DROP TABLE rent_periodation');
        $this->addSql('DROP TABLE states');
    }
}
