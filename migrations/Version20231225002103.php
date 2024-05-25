<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231225002103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('ALTER TABLE basket_goods DROP CONSTRAINT fk_531bf2171be1fb52');
        $this->addSql('ALTER TABLE basket_goods DROP CONSTRAINT fk_531bf217b7683595');
        $this->addSql('ALTER TABLE basket_users DROP CONSTRAINT fk_42fbeed31be1fb52');
        $this->addSql('ALTER TABLE basket_users DROP CONSTRAINT fk_42fbeed367b3b43d');
        $this->addSql('DROP TABLE basket_goods');
        $this->addSql('DROP TABLE basket_users');
        $this->addSql('ALTER TABLE basket ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE basket ADD good_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B61E73083 FOREIGN KEY (good_id_id) REFERENCES goods (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2246507B9D86650F ON basket (user_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2246507B61E73083 ON basket (good_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE basket_goods (basket_id INT NOT NULL, goods_id INT NOT NULL, PRIMARY KEY(basket_id, goods_id))');
        $this->addSql('CREATE INDEX idx_531bf217b7683595 ON basket_goods (goods_id)');
        $this->addSql('CREATE INDEX idx_531bf2171be1fb52 ON basket_goods (basket_id)');
        $this->addSql('CREATE TABLE basket_users (basket_id INT NOT NULL, users_id INT NOT NULL, PRIMARY KEY(basket_id, users_id))');
        $this->addSql('CREATE INDEX idx_42fbeed367b3b43d ON basket_users (users_id)');
        $this->addSql('CREATE INDEX idx_42fbeed31be1fb52 ON basket_users (basket_id)');
        $this->addSql('ALTER TABLE basket_goods ADD CONSTRAINT fk_531bf2171be1fb52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket_goods ADD CONSTRAINT fk_531bf217b7683595 FOREIGN KEY (goods_id) REFERENCES goods (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket_users ADD CONSTRAINT fk_42fbeed31be1fb52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket_users ADD CONSTRAINT fk_42fbeed367b3b43d FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket DROP CONSTRAINT FK_2246507B9D86650F');
        $this->addSql('ALTER TABLE basket DROP CONSTRAINT FK_2246507B61E73083');
        $this->addSql('DROP INDEX UNIQ_2246507B9D86650F');
        $this->addSql('DROP INDEX UNIQ_2246507B61E73083');
        $this->addSql('ALTER TABLE basket DROP user_id_id');
        $this->addSql('ALTER TABLE basket DROP good_id_id');
    }
}
