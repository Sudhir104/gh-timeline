#!/bin/bash
CRON_JOB="*/5 * * * * php $(pwd)/cron.php"
crontab -l | grep -F "$CRON_JOB" > /dev/null 2>&1
if [ $? -eq 0 ]; then
    echo "Cron job already exists."
else
    (crontab -l 2>/dev/null; echo "$CRON_JOB") | crontab -
    echo "Cron job added."
fi