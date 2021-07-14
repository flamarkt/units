import {Vnode} from 'mithril';
import Page from 'flarum/common/components/Page';
import LinkButton from 'flarum/common/components/LinkButton';
import UnitListState from '../states/UnitListState';
import UnitList from '../components/UnitList';

export default class UnitIndexPage extends Page {
    state!: UnitListState;

    oninit(vnode: Vnode) {
        super.oninit(vnode);

        this.state = new UnitListState();
        this.state.refresh();
    }

    view() {
        return m('.UnitIndexPage', m('.container', [
            m('.Form-group', [
                LinkButton.component({
                    className: 'Button',
                    href: app.route('units.show', {
                        id: 'new',
                    }),
                }, 'New unit'),
            ]),
            m(UnitList, {
                state: this.state,
            }),
        ]));
    }
}
