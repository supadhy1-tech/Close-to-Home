# Run Website Locally with Visual Studio Code

This guide shows you how to run your website using VS Code with a simple PHP server.

---

## 📋 What You Need to Install

### 1. Visual Studio Code
- Download: https://code.visualstudio.com/
- Install (it's free)

### 2. PHP
- **Windows:** https://windows.php.net/download/
  - Download "Thread Safe" ZIP version
  - Extract to `C:\php`
  - Add to PATH (see instructions below)
  
- **Mac:** Already installed! Or use:
  ```bash
  brew install php
  ```
  
- **Linux:**
  ```bash
  sudo apt install php php-mysql
  ```

### 3. MySQL (Database)
- **Windows:** https://dev.mysql.com/downloads/installer/
  - Download "MySQL Installer"
  - Install MySQL Server only
  
- **Mac:**
  ```bash
  brew install mysql
  brew services start mysql
  ```
  
- **Linux:**
  ```bash
  sudo apt install mysql-server
  sudo systemctl start mysql
  ```

---

## 🚀 Step-by-Step Setup

### STEP 1: Install PHP (Windows Only - Skip if Mac/Linux)

1. **Download PHP:**
   - Go to: https://windows.php.net/download/
   - Download latest "VS16 x64 Thread Safe" ZIP
   - Example: `php-8.2.x-Win32-vs16-x64.zip`

2. **Extract PHP:**
   - Extract to: `C:\php`
   - You should have: `C:\php\php.exe`

3. **Add PHP to PATH:**
   - Press `Windows + R`
   - Type: `sysdm.cpl` and press Enter
   - Click "Advanced" tab
   - Click "Environment Variables"
   - Under "System variables", find "Path"
   - Click "Edit"
   - Click "New"
   - Add: `C:\php`
   - Click "OK" on all windows

4. **Test PHP:**
   - Open Command Prompt (cmd)
   - Type: `php -v`
   - Should show PHP version

---

### STEP 2: Install MySQL

1. **Download MySQL Installer:**
   - Go to: https://dev.mysql.com/downloads/installer/
   - Download "Windows (x86, 32-bit), MSI Installer"

2. **Install MySQL:**
   - Run installer
   - Choose "Custom" installation
   - Select "MySQL Server" only
   - Click "Execute" to install
   - Set root password (remember this!)
   - Click through remaining steps

3. **Verify MySQL:**
   - Open Command Prompt
   - Type: `mysql --version`
   - Should show MySQL version

---

### STEP 3: Extract Website Files

1. **Extract the ZIP:**
   - Extract `close-to-saginaw-unified.zip` to a folder
   - Example: `C:\Users\YourName\Documents\close-to-saginaw-pro\`
   - Or anywhere you want!

---

### STEP 4: Open in Visual Studio Code

1. **Open VS Code**

2. **Open Folder:**
   - File → Open Folder
   - Select: `close-to-saginaw-pro` folder
   - Click "Select Folder"

3. **Install PHP Server Extension:**
   - Click Extensions icon (left sidebar) or press `Ctrl+Shift+X`
   - Search for: "PHP Server"
   - Install "PHP Server" by brapifra
   - Reload VS Code

---

### STEP 5: Create the Database

1. **Open Command Prompt or Terminal**

2. **Login to MySQL:**
   ```bash
   mysql -u root -p
   ```
   - Enter your MySQL root password

3. **Create Database:**
   ```sql
   CREATE DATABASE close_to_saginaw;
   EXIT;
   ```

4. **Import Database:**
   ```bash
   mysql -u root -p close_to_saginaw < "C:\path\to\close-to-saginaw-pro\database_setup_complete.sql"
   ```
   - Replace path with your actual path
   - Enter password when prompted

---

### STEP 6: Configure Database Connection

1. **In VS Code, open:** `includes/config.php`

2. **Update the file:**
   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', 'your_mysql_password');  // Your MySQL root password
   define('DB_NAME', 'close_to_saginaw');
   ?>
   ```

3. **Save the file** (`Ctrl+S`)

---

### STEP 7: Start the PHP Server

1. **In VS Code:**
   - Right-click on `index.php` in the file explorer
   - Select "PHP Server: Serve project"
   
   **OR**
   
   - Press `Ctrl+Shift+P` (Command Palette)
   - Type: "PHP Server: Serve project"
   - Press Enter

2. **Server starts automatically!**
   - Default address: `http://localhost:3000`
   - VS Code will show the port in the output

3. **Open Browser:**
   - Your default browser should open automatically
   - If not, go to: `http://localhost:3000`

---

### STEP 8: Access Your Website

**Public Website:**
- `http://localhost:3000/`

**Admin Panel:**
- `http://localhost:3000/admin/`
- Username: `admin`
- Password: `admin123`

---

## 🎯 Quick Command Reference

### Start Server (Alternative Method - Manual):

If the PHP Server extension doesn't work, use this:

1. **Open Terminal in VS Code:**
   - View → Terminal (or `Ctrl+` `)

2. **Run PHP Server:**
   ```bash
   php -S localhost:8000
   ```

3. **Access site:**
   - `http://localhost:8000/`

4. **Stop server:**
   - Press `Ctrl+C` in terminal

---

## 🔧 Troubleshooting

### "php is not recognized"
**Problem:** PHP not in PATH

**Solution:**
- Restart computer after adding PHP to PATH
- Or use full path: `C:\php\php.exe -S localhost:8000`

### "Can't connect to database"
**Problem:** MySQL not running or wrong credentials

**Solution:**
- Check MySQL is running:
  ```bash
  # Windows
  net start MySQL80
  
  # Mac
  brew services start mysql
  
  # Linux
  sudo systemctl start mysql
  ```
- Verify password in `includes/config.php`

### "Access denied for user"
**Problem:** Wrong MySQL password

**Solution:**
- Update `includes/config.php` with correct password
- Or reset MySQL root password

### "Table doesn't exist"
**Problem:** Database not imported

**Solution:**
- Re-import database:
  ```bash
  mysql -u root -p close_to_saginaw < database_setup_complete.sql
  ```

### Port 3000 already in use
**Problem:** Another app using port 3000

**Solution:**
- Use different port:
  ```bash
  php -S localhost:8080
  ```

---

## 💡 VS Code Extensions (Optional but Helpful)

Install these for better development:

1. **PHP Intelephense** - Code completion
2. **PHP Debug** - Debugging support
3. **MySQL** - Database management in VS Code
4. **Live Server** - Auto-refresh (for HTML/CSS changes)

To install:
- Click Extensions (`Ctrl+Shift+X`)
- Search for extension name
- Click "Install"

---

## ⚡ Daily Workflow

### Starting Work:
1. Open VS Code
2. Open your project folder
3. Start MySQL service
4. Right-click `index.php` → "PHP Server: Serve project"
5. Browser opens automatically

### Stopping:
1. Close browser
2. In VS Code terminal, press `Ctrl+C`
3. Close VS Code

---

## 📁 Project Structure in VS Code

```
close-to-saginaw-pro/
├── 📄 index.php              ← Right-click this to start server
├── 📄 includes/config.php    ← Edit database settings here
├── 📄 database_setup_complete.sql  ← Import this to MySQL
├── 📁 admin/                 ← Admin panel files
├── 📁 css/                   ← Stylesheets
├── 📁 js/                    ← JavaScript
└── 📁 services/              ← Service pages
```

---

## ✅ Checklist

- [ ] Visual Studio Code installed
- [ ] PHP installed and in PATH
- [ ] MySQL installed and running
- [ ] Database created: `close_to_saginaw`
- [ ] SQL file imported
- [ ] `config.php` updated with MySQL password
- [ ] PHP Server extension installed in VS Code
- [ ] Project opened in VS Code
- [ ] Server started successfully
- [ ] Website opens in browser: `http://localhost:3000`
- [ ] Admin panel accessible: `http://localhost:3000/admin/`

---

## 🎉 You're Done!

Your website is now running locally on your computer!

**Start Server:** Right-click `index.php` → PHP Server: Serve project  
**Stop Server:** `Ctrl+C` in terminal  
**View Site:** `http://localhost:3000`  
**Admin:** `http://localhost:3000/admin/`

---

## 🆘 Still Need Help?

Common issues:
- MySQL not starting → Restart your computer
- Can't connect to database → Check password in config.php
- Port already in use → Use different port: `php -S localhost:8080`
- PHP not found → Restart computer after adding to PATH
