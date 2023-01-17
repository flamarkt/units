import app from 'flamarkt/backoffice/backoffice/app';
import AbstractList from 'flamarkt/backoffice/backoffice/components/AbstractList';
import LinkButton from 'flarum/common/components/LinkButton';
import Button from 'flarum/common/components/Button';
import Unit from '../../common/models/Unit';

export default class UnitList extends AbstractList<Unit> {
    head() {
        const columns = super.head();

        columns.add('slug', m('th', 'Slug'));

        return columns;
    }

    columns(unit: Unit) {
        const columns = super.columns(unit);

        columns.add('slug', m('td', unit.slug()), 10);

        return columns;
    }

    actions(unit: Unit) {
        const actions = super.actions(unit);

        actions.add('edit', LinkButton.component({
            className: 'Button Button--icon',
            icon: 'fas fa-pen',
            href: app.route('units.show', {
                id: unit.id(),
            }),
        }));

        actions.add('hide', Button.component({
            className: 'Button Button--icon',
            icon: 'fas fa-times',
        }));

        return actions;
    }
}
