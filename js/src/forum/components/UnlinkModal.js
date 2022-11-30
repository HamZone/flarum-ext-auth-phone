import Modal from 'flarum/components/Modal';
import Button from 'flarum/components/Button';

export default class UnlinkModal extends Modal {
    className() {
        return `SMSAuthUnlinkModal Modal--small`;
    }

    title() {
        return app.translator.trans(`hamzone-auth-phone.forum.modals.unlink.title`);
    }

    content() {
        return (
            <div className="Modal-body">
                <div className="Form Form--centered">
                    <div className="Form-group" id="submit-button-group">
                        <h3>{app.translator.trans(`hamzone-auth-phone.forum.modals.unlink.title`)}</h3>
                        <p className={`SMSAuthText--danger`}><i className="fas fa-exclamation-triangle fa-fw" />
                            <b>{app.translator.trans(`hamzone-auth-phone.forum.modals.unlink.no_providers`)}</b>
                        </p>
                        <br />
                        <div className="ButtonGroup">
                            <Button type={'submit'} className={`Button SMSAuthButton--danger`} icon={'fas fa-exclamation-triangle'}
                                loading={this.loading}>
                                {app.translator.trans(`hamzone-auth-phone.forum.modals.unlink.confirm`)}
                            </Button>
                            <Button className={'Button Button--primary'} icon={'fas fa-exclamation-triangle'}
                                onclick={() => this.hide()} disabled={this.loading}>
                                {app.translator.trans(`hamzone-auth-phone.forum.modals.unlink.cancel`)}
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    onsubmit(e) {

        let alert;

        e.preventDefault();
        this.loading = true;
        const user = app.session.user;
        user
          .save({
            phone: "",
          })
          .catch((error) => {
                app.alerts.show(
                Alert,
                { type: 'error' },
                error
                );
            })
          .then(() => {
                this.hide();
                m.redraw();
                alert = app.alerts.show({ type: 'success' }, app.translator.trans(`hamzone-auth-phone.forum.alerts.unlink_success`));
          });
        setTimeout(() => {
            app.alerts.dismiss(alert);
            window.location.reload();
        }, 3000);
    }
}
