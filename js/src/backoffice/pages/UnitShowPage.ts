import AbstractShowPage from 'flamarkt/core/common/pages/AbstractShowPage';
import SubmitButton from 'flamarkt/core/backoffice/components/SubmitButton';
import LoadingIndicator from 'flarum/common/components/LoadingIndicator';
import Select from 'flarum/common/components/Select';
import ItemList from 'flarum/common/utils/ItemList';
import Unit from '../../common/models/Unit';

export default class UnitShowPage extends AbstractShowPage {
    unit: Unit | null = null;
    dirty: boolean = false;
    saving: boolean = false;
    slug: string = '';
    preset: string | null = null;
    labelSingular: string = '';
    labelPlural: string = '';
    decimals: number = 0;
    defaultMin: number | null = null;
    defaultMax: number | null = null;
    defaultStep: number | null = null;

    newRecord() {
        return app.store.createRecord('flamarkt-units');
    }

    findType() {
        return 'flamarkt/units';
    }

    show(unit: Unit) {
        this.unit = unit;
        this.slug = unit.slug() || '';
        this.preset = unit.preset() || null;
        this.labelSingular = unit.labelSingular() || '';
        this.labelPlural = unit.labelPlural() || '';
        this.decimals = unit.decimals() || 0;
        this.defaultMin = unit.defaultMin();
        this.defaultMax = unit.defaultMax();
        this.defaultStep = unit.defaultStep();

        app.setTitle(unit.slug());
        app.setTitleCount(0);
    }

    view() {
        if (!this.unit) {
            return LoadingIndicator.component();
        }

        return m('form.UnitShowPage', {
            onsubmit: this.onsubmit.bind(this),
        }, m('.container', this.fields().toArray()));
    }

    fields(): ItemList {
        const fields = new ItemList();

        fields.add('slug', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.units.field.slug')),
            m('input.FormControl', {
                type: 'text',
                value: this.slug,
                oninput: (event: Event) => {
                    this.slug = (event.target as HTMLInputElement).value;
                    this.dirty = true;
                },
            }),
        ]));

        fields.add('preset', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.units.field.preset')),
            Select.component({
                value: this.preset || 'default',
                onchange: (value: string) => {
                    this.preset = value === 'default' ? null : value;
                },
                options: this.presetOptions(),
            }),
        ]));

        fields.add('labelSingular', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.units.field.labelSingular')),
            m('input.FormControl', {
                type: 'text',
                value: this.labelSingular,
                oninput: (event: Event) => {
                    this.labelSingular = (event.target as HTMLInputElement).value;
                    this.dirty = true;
                },
            }),
        ]));

        fields.add('labelPlural', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.units.field.labelPlural')),
            m('input.FormControl', {
                type: 'text',
                value: this.labelPlural,
                oninput: (event: Event) => {
                    this.labelPlural = (event.target as HTMLInputElement).value;
                    this.dirty = true;
                },
            }),
        ]));

        fields.add('decimals', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.units.field.decimals')),
            m('input.FormControl', {
                type: 'number',
                value: this.decimals,
                onchange: (event: Event) => {
                    this.decimals = parseInt((event.target as HTMLInputElement).value);
                    this.dirty = true;
                },
            }),
        ]));

        fields.add('defaultMin', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.units.field.defaultMin')),
            m('input.FormControl', {
                type: 'number',
                value: this.defaultMin,
                onchange: (event: Event) => {
                    const {value} = event.target as HTMLInputElement;
                    this.defaultMin = value === '' ? null : parseInt(value);
                    this.dirty = true;
                },
            }),
        ]));

        fields.add('defaultMax', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.units.field.defaultMax')),
            m('input.FormControl', {
                type: 'number',
                value: this.defaultMax,
                onchange: (event: Event) => {
                    const {value} = event.target as HTMLInputElement;
                    this.defaultMax = value === '' ? null : parseInt(value);
                    this.dirty = true;
                },
            }),
        ]));

        fields.add('defaultStep', m('.Form-group', [
            m('label', app.translator.trans('flamarkt-units.backoffice.units.field.defaultStep')),
            m('input.FormControl', {
                type: 'number',
                value: this.defaultStep,
                onchange: (event: Event) => {
                    const {value} = event.target as HTMLInputElement;
                    this.defaultStep = value === '' ? null : parseInt(value);
                    this.dirty = true;
                },
            }),
        ]));

        fields.add('submit', m('.Form-group', [
            SubmitButton.component({
                loading: this.saving,
                dirty: this.dirty,
                exists: this.unit!.exists,
            }),
        ]), -10);

        return fields;
    }

    presetOptions() {
        return {
            default: 'No preset',
            g: 'Grams / KG',
        };
    }

    data() {
        return {
            slug: this.slug,
            preset: this.preset,
            labelSingular: this.labelSingular,
            labelPlural: this.labelPlural,
            decimals: this.decimals,
            defaultMin: this.defaultMin,
            defaultMax: this.defaultMax,
            defaultStep: this.defaultStep,
        };
    }

    onsubmit(event: Event) {
        event.preventDefault();

        this.saving = true;

        // @ts-ignore
        this.unit.save(this.data()).then(unit => {
            this.unit = unit;

            this.saving = false;
            this.dirty = false;
            m.redraw();
        }).catch(error => {
            this.saving = false;
            m.redraw();
        });
    }
}
