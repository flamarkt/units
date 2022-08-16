import Model from 'flarum/common/Model';

export default class Unit extends Model {
    slug = Model.attribute<string>('slug');
    preset = Model.attribute<string>('preset');
    labelSingular = Model.attribute<string>('labelSingular');
    labelPlural = Model.attribute<string>('labelPlural');
    decimals = Model.attribute<number>('decimals');
    defaultMin = Model.attribute<number>('defaultMin');
    defaultMax = Model.attribute<number>('defaultMax');
    defaultStep = Model.attribute<number>('defaultStep');

    apiEndpoint() {
        return '/flamarkt/units' + (this.exists ? '/' + (this.data as any).id : '');
    }
}
