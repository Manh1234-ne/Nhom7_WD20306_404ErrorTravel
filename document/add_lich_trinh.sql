-- Migration: add `lich_trinh` column to `tour` table
-- Purpose: store itinerary JSON (title, time, location, desc, image path)
-- Usage: Import this SQL file into your MySQL database (phpMyAdmin / mysql client)

-- Note: this script checks information_schema for existing column and only runs ALTER if missing.
-- It should work on MySQL versions without ALTER ... IF NOT EXISTS.

SET @db := DATABASE();
SELECT @db AS using_database;

SET @col_exists := (
  SELECT COUNT(*)
  FROM information_schema.COLUMNS
  WHERE TABLE_SCHEMA = @db
    AND TABLE_NAME = 'tour'
    AND COLUMN_NAME = 'lich_trinh'
);

SELECT @col_exists AS lich_trinh_exists;

SET @stmt := IF(@col_exists = 0,
  'ALTER TABLE `tour` ADD COLUMN `lich_trinh` TEXT NULL;',
  'SELECT "column lich_trinh already exists in table tour";'
);

PREPARE alter_stmt FROM @stmt;
EXECUTE alter_stmt;
DEALLOCATE PREPARE alter_stmt;

-- Optional rollback (manually run if needed):
-- ALTER TABLE `tour` DROP COLUMN `lich_trinh`;

-- End of migration
