export default class SMSApplication {
    linkDone(returnCode) {

        let alert;

        switch (returnCode) {

            case 'already_linked':
                app.modal.close();
                alert = app.alerts.show({ type: 'error' }, app.translator.trans(`hamzone-auth-phone.forum.alerts.already_linked`));
                break;
            case 'already_used':
                alert = app.alerts.show({ type: 'error' }, app.translator.trans(`hamzone-auth-phone.forum.alerts.already_used`));
                break;
            case 'done':
                app.modal.close();
                app.session.user.savePreferences();
                alert = app.alerts.show({ type: 'success' }, app.translator.trans(`hamzone-auth-phone.forum.alerts.link_success`));
                break;
            case 'error':
                alert = app.alerts.show({ type: 'error' }, app.translator.trans(`hamzone-auth-phone.forum.alerts.error`));
                break;
        }

        setTimeout(() => {
            app.alerts.dismiss(alert);
        }, 5000);
    }
}