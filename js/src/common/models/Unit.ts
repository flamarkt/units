import Model from 'flarum/common/Model';

export default class Unit extends Model {
    slug = Model.attribute('slug');
    preset = Model.attribute('preset');
    labelSingular = Model.attribute('labelSingular');
    labelPlural = Model.attribute('labelPlural');
    decimals = Model.attribute('decimals');
    defaultMin = Model.attribute('defaultMin');
    defaultMax = Model.attribute('defaultMax');
    defaultStep = Model.attribute('defaultStep');

    apiEndpoint() {
        return '/flamarkt/units' + (this.exists ? '/' + this.data.id : '');
    }
}
