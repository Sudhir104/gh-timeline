# GH Timeline – rtCamp Assignment

This project is a PHP-based email verification system where users can subscribe using their email, verify with a 6-digit code, and receive GitHub timeline updates every 5 minutes via email. It also includes an unsubscribe system and a CRON job setup script.

---

## 📌 Features Implemented

✅ Email registration form with 6-digit code verification  
✅ Verified emails are stored in `registered_emails.txt`  
✅ GitHub timeline (dummy) fetched and sent every 5 minutes via CRON  
✅ Emails are sent using PHP’s `mail()` in HTML format  
✅ Each email includes an unsubscribe link  
✅ Unsubscribe feature works via code confirmation  
✅ CRON setup handled by `setup_cron.sh` script  
✅ All code is inside the `src/` directory  
✅ No third-party libraries used  
✅ No database used (only text file)

---

## 🧪 How to Run the Project Locally

### 1. Clone the Repo
```bash
git clone https://github.com/Sudhir104/gh-timeline.git
cd gh-timeline
