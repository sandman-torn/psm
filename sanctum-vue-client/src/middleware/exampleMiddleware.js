export default function exampleMiddleware({ next }) {
  // Perform some logic here
  console.log('Running example middleware');

  // Call the next function to proceed with the navigation
  return next();
}
