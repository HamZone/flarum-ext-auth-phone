import SettingsPage from './components/SettingsPage';

app.initializers.add('hamzone/flarum-ext-auth-phone', () => {
  console.log('[hamzone/flarum-ext-auth-phone] Hello, admin!');

  //注入
  app.extensionData.for(config.module.name).registerPage(SettingsPage);
});
