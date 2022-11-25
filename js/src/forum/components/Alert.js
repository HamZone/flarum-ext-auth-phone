
import app from 'flarum/forum/app';
import listItems from 'flarum/common/helpers/listItems';
import LinkModal from './LinkModal';
import Button from 'flarum/common/components/Button';

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

    const controls = [
      Button.component(
        {
          className: 'Button Button--link',
          onclick: () => {
            app.modal.show(LinkModal);
          },
        },
        app.translator.trans('hamzone-auth-phone.forum.alerts.toLink')
      ),
    ];
    const dismissControl = [];
    return m(
        '.Alert.Alert-info',
        m('.container', [
          m(
            'span.Alert-body', app.translator.trans(`hamzone-auth-phone.forum.alerts.limit`)
          ),
          m('ul.Alert-controls',  listItems(controls.concat(dismissControl))),
        ])
    );
  }
    
}
