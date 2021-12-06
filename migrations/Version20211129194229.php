<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211129194229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE convention (id INT AUTO_INCREMENT NOT NULL, code_p_id INT NOT NULL, mat_id INT DEFAULT NULL, INDEX IDX_8556657EE5900963 (code_p_id), INDEX IDX_8556657EDCA7C833 (mat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investisseur (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, nom_societe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, libelle_p VARCHAR(255) NOT NULL, secteur_p VARCHAR(255) NOT NULL, cout_fixe INT NOT NULL, cout_var INT NOT NULL, duree_p DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE convention ADD CONSTRAINT FK_8556657EE5900963 FOREIGN KEY (code_p_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE convention ADD CONSTRAINT FK_8556657EDCA7C833 FOREIGN KEY (mat_id) REFERENCES investisseur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE convention DROP FOREIGN KEY FK_8556657EDCA7C833');
        $this->addSql('ALTER TABLE convention DROP FOREIGN KEY FK_8556657EE5900963');
        $this->addSql('DROP TABLE convention');
        $this->addSql('DROP TABLE investisseur');
        $this->addSql('DROP TABLE projet');
    }
}
