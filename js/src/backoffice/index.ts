import {extend} from 'flarum/common/extend';
import ActiveLinkButton from 'flamarkt/backoffice/common/components/ActiveLinkButton';
import BackofficeNav from 'flamarkt/backoffice/backoffice/components/BackofficeNav';
import ProductShowPage from 'flamarkt/core/backoffice/pages/ProductShowPage';
import Select from 'flarum/common/components/Select';
import Unit from '../common/models/Unit';
import UnitIndexPage from './pages/UnitIndexPage';
import UnitShowPage from './pages/UnitShowPage';
import {backoffice} from './compat';
import {common} from '../common/compat';

export {
    backoffice,
    common,
};

app.initializers.add('flamarkt-units', () => {
    app.store.models['flamarkt-units'] = Unit;

    app.routes['units.index'] = {
        path: '/units',
        component: UnitIndexPage,
    };
    app.routes['units.show'] = {
        path: '/units/:id',
        component: UnitShowPage,
    };

    extend(BackofficeNav.prototype, 'items', function (items) {
        items.add('units', ActiveLinkButton.component({
            href: app.route('units.index'),
            icon: 'fas fa-balance-scale-left',
            activeRoutes: [
                'units.*',
            ],
        }, 'Units'));
    });

    extend(ProductShowPage.prototype, 'show', function () {
        this.unit = this.product!.attribute('unit');
        this.amountMin = this.product!.attribute('amountMinEdit');
        this.amountMax = this.product!.attribute('amountMaxEdit');
        this.amountStep = this.product!.attribute('amountStepEdit');
    });

    extend(ProductShowPage.prototype, 'fields', function (fields) {
        const options = { //TODO: build from list of units
            default: 'Default',
            g: 'Grams',
        };

        fields.add('unit', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.products.field.unit')),
            Select.component({
                value: this.unit || 'default',
                onchange: (value: string) => {
                    this.unit = value === 'default' ? null : value;
                    this.dirty = true;
                },
                options,
            }),
        ]));

        fields.add('amountMin', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.products.field.amountMin')),
            m('input.FormControl', {
                type: 'number',
                value: this.amountMin,
                onchange: (event: Event) => {
                    const {value} = event.target as HTMLInputElement;
                    this.amountMin = value === '' ? null : parseInt(value);
                    this.dirty = true;
                },
                options,
            }),
        ]));

        fields.add('amountMax', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.products.field.amountMax')),
            m('input.FormControl', {
                type: 'number',
                value: this.amountMax,
                onchange: (event: Event) => {
                    const {value} = event.target as HTMLInputElement;
                    this.amountMax = value === '' ? null : parseInt(value);
                    this.dirty = true;
                },
                options,
            }),
        ]));

        fields.add('amountStep', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.products.field.amountStep')),
            m('input.FormControl', {
                type: 'number',
                value: this.amountStep,
                onchange: (event: Event) => {
                    const {value} = event.target as HTMLInputElement;
                    this.amountStep = value === '' ? null : parseInt(value);
                    this.dirty = true;
                },
                options,
            }),
        ]));
    });

    extend(ProductShowPage.prototype, 'data', function (this: ProductShowPage, data: any) {
        data.unit = this.unit;
        data.amountMin = this.amountMin;
        data.amountMax = this.amountMax;
        data.amountStep = this.amountStep;
    });
});
