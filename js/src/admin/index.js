import app from 'flarum/app';
import SettingsPage from './components/SettingsPage';

app.initializers.add('hamzone/hamzone-auth-phone', () => {
  app.extensionData.for("hamzone-auth-phone").registerPage(SettingsPage);
});
