<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180601174650 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE build (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, wood INT NOT NULL, stone INT NOT NULL, gold INT NOT NULL, time INT NOT NULL, type VARCHAR(255) NOT NULL, level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user2build (id INT AUTO_INCREMENT NOT NULL, build_id INT DEFAULT NULL, user_id INT DEFAULT NULL, state LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', datetime_start DATETIME DEFAULT NULL, datetime_end DATETIME DEFAULT NULL, INDEX build_id (build_id), INDEX user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user2source (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, wood INT NOT NULL, stone INT NOT NULL, gold INT NOT NULL, INDEX user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user2build ADD CONSTRAINT FK_EB08150717C13F8B FOREIGN KEY (build_id) REFERENCES build (id)');
        $this->addSql('ALTER TABLE user2build ADD CONSTRAINT FK_EB081507A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user2source ADD CONSTRAINT FK_D0B9496BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, CHANGE login login VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user2build DROP FOREIGN KEY FK_EB08150717C13F8B');
        $this->addSql('DROP TABLE build');
        $this->addSql('DROP TABLE user2build');
        $this->addSql('DROP TABLE user2source');
        $this->addSql('ALTER TABLE user DROP username, DROP email, CHANGE login login INT NOT NULL');
    }
}
