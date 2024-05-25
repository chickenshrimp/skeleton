<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231223150459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE basket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE goods_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shops_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE basket (id INT NOT NULL, number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE basket_users (basket_id INT NOT NULL, users_id INT NOT NULL, PRIMARY KEY(basket_id, users_id))');
        $this->addSql('CREATE INDEX IDX_42FBEED31BE1FB52 ON basket_users (basket_id)');
        $this->addSql('CREATE INDEX IDX_42FBEED367B3B43D ON basket_users (users_id)');
        $this->addSql('CREATE TABLE basket_goods (basket_id INT NOT NULL, goods_id INT NOT NULL, PRIMARY KEY(basket_id, goods_id))');
        $this->addSql('CREATE INDEX IDX_531BF2171BE1FB52 ON basket_goods (basket_id)');
        $this->addSql('CREATE INDEX IDX_531BF217B7683595 ON basket_goods (goods_id)');
        $this->addSql('CREATE TABLE goods (id INT NOT NULL, shop_id_id INT NOT NULL, good_name VARCHAR(50) NOT NULL, cost INT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_563B92DB852C405 ON goods (shop_id_id)');
        $this->addSql('CREATE TABLE shops (id INT NOT NULL, owner_id_id INT NOT NULL, shop_name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_237A67838FDDAB70 ON shops (owner_id_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, login VARCHAR(60) NOT NULL, password VARCHAR(60) NOT NULL, has_ability_for_shop BOOLEAN NOT NULL, admin_role BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE basket_users ADD CONSTRAINT FK_42FBEED31BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket_users ADD CONSTRAINT FK_42FBEED367B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket_goods ADD CONSTRAINT FK_531BF2171BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket_goods ADD CONSTRAINT FK_531BF217B7683595 FOREIGN KEY (goods_id) REFERENCES goods (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE goods ADD CONSTRAINT FK_563B92DB852C405 FOREIGN KEY (shop_id_id) REFERENCES shops (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shops ADD CONSTRAINT FK_237A67838FDDAB70 FOREIGN KEY (owner_id_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE basket_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE goods_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shops_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('ALTER TABLE basket_users DROP CONSTRAINT FK_42FBEED31BE1FB52');
        $this->addSql('ALTER TABLE basket_users DROP CONSTRAINT FK_42FBEED367B3B43D');
        $this->addSql('ALTER TABLE basket_goods DROP CONSTRAINT FK_531BF2171BE1FB52');
        $this->addSql('ALTER TABLE basket_goods DROP CONSTRAINT FK_531BF217B7683595');
        $this->addSql('ALTER TABLE goods DROP CONSTRAINT FK_563B92DB852C405');
        $this->addSql('ALTER TABLE shops DROP CONSTRAINT FK_237A67838FDDAB70');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE basket_users');
        $this->addSql('DROP TABLE basket_goods');
        $this->addSql('DROP TABLE goods');
        $this->addSql('DROP TABLE shops');
        $this->addSql('DROP TABLE users');
    }
}
