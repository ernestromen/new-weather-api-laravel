# Use an official Node.js runtime as a parent image
FROM node:14

# Set the working directory in the container
WORKDIR /var/www/vue-project

# Copy package.json and package-lock.json to the container
COPY package*.json ./

# Install the project dependencies
RUN npm install

# Copy the rest of your application code to the container
COPY . .

# Replace this with your Vue.js build command (e.g., npm run build)
# CMD ["npm", "run", "dev"]
CMD ["npm", "run", "dev",  "--", "--host", "0.0.0.0", "--port", "5173"]