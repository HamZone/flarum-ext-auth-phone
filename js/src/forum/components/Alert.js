
import app from 'flarum/forum/app';

let temporarilyHidden = false;

export default class UpdateAlert {
  shouldShowAlert() {
    if (temporarilyHidden) {
      return false;
    }

    const user = app.session.user;

    return user && true;
  }

  view(){
    if (!this.shouldShowAlert()) {
      return m('div');
    }

    return m(
        '.Alert.Alert-info',
        m('.container', [
          m(
            'span.Alert-body', app.translator.trans(`hamzone-auth-phone.forum.alerts.limit`)
          ),
          m('ul.Alert-controls', ""),
        ])
    );
  }
    
}
