import addAlert from './addAlert';

export * from './components';

app.initializers.add('hamzone/flarum-ext-auth-phone', () => {
  console.log('[hamzone/flarum-ext-auth-phone] Hello, forum! test');
  addAlert();
});
