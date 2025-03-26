# Vajram Vivera Website - https://vajramvivera.com/

## Project Overview
Vajram Vivera is a comprehensive website developed for Vajram group, leveraging MySQL for backend data management and hosted on AWS Lightsail.

## Technology Stack
- **Frontend:**
  - HTML5
  - CSS3
  - JavaScript (ES6+)
- **Backend:**
  - PHP
  - MySQL Database
- **Hosting & Deployment:**
  - AWS Lightsail
  - FileZilla for File Transfer

## System Requirements
- MySQL 5.7+ or MySQL 8.0
- PHP 7.4+
- AWS Lightsail Instance
- FileZilla Client

## Database Setup

### MySQL Database Configuration
1. Create Database
```sql
CREATE DATABASE vajram_vivera;
USE vajram_vivera;

-- Create necessary tables
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add more table creation scripts as needed
```

2. Database Connection (config/database.php)
```php
<?php
$host = 'localhost';
$db   = 'vajram_vivera';
$user = 'your_mysql_username';
$pass = 'your_mysql_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
```

## AWS Lightsail Deployment

### Server Preparation
1. Launch AWS Lightsail Instance
   - Choose Linux/Unix blueprint (Ubuntu recommended)
   - Select appropriate instance plan
   - Configure firewall (open ports 22, 80, 443)

2. Connect to Server
```bash
# Use SSH key provided by AWS Lightsail
ssh -i /path/to/private/key ubuntu@your-lightsail-ip
```

3. Install Required Software
```bash
# Update system
sudo apt-get update
sudo apt-get upgrade

# Install Apache, PHP, MySQL
sudo apt-get install apache2 php mysql-server php-mysql

# Secure MySQL installation
sudo mysql_secure_installation
```

### FileZilla Deployment Process
1. Open FileZilla
2. Create New Site Connection
   - Protocol: SFTP
   - Host: Your AWS Lightsail Public IP
   - Port: 22
   - Logon Type: Key File
   - User: ubuntu
   - Key File: Select your .pem private key

3. File Transfer Workflow
   - Connect to server
   - Navigate to web root: `/var/www/html`
   - Upload project files
   - Set correct permissions:
     ```bash
     sudo chown -R www-data:www-data /var/www/html
     sudo chmod -R 755 /var/www/html
     ```

## Security Recommendations
- Use strong, unique passwords
- Enable SSL/TLS (Let's Encrypt)
- Configure AWS Lightsail Firewall
- Implement PHP input validation
- Use prepared statements for database queries

## Backup Strategy
1. MySQL Database Backup
```bash
# Automated backup script (crontab)
mysqldump -u username -p vajram_vivera > backup_$(date +"%Y%m%d").sql
```

2. FileZilla Periodic Backup
   - Use scheduled synchronization
   - Maintain local and remote backup copies

## Troubleshooting
- Check Apache logs: `/var/log/apache2/error.log`
- MySQL logs: `/var/log/mysql/error.log`
- Verify file permissions
- Check PHP error reporting

## Continuous Deployment
- Consider implementing Git workflows
- Use GitHub Actions or similar CI/CD tools
- Automate testing and deployment processes

## Environment Configuration
Create `.env` file:
```
DB_HOST=localhost
DB_NAME=vajram_vivera
DB_USER=your_username
DB_PASS=your_password
AWS_REGION=your-aws-region
```

## Contributing
1. Fork Repository
2. Create Feature Branch
3. Commit Changes
4. Push to Branch
5. Open Pull Request

## License
[Specify Your License]

## Contact
- Email: contact@vajramvivera.com
- Website: www.vajramvivera.com
- Support: support@vajramvivera.com

---

**Disclaimer:** Ensure you replace placeholder values with your actual configuration details.
