FROM sail-8.1/app

# Install cron
RUN apt-get update && apt-get install -y cron

# Start cron service
CMD cron -f
