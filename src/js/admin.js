const { registerBlockType } = wp.blocks
const { RichText } = wp.editor

import edit from './edit'
import save from './save'

registerBlockType('fnwq/qualifications', {
    title: 'Workana Qualifications',
    category: 'widgets',
    attributes: {
        qualifications: {
            source: 'query',
            type: 'array',
            selector: 'li.qualifications-list__item',
            query: {
                clientName: {
                    type: 'string',
                    source: 'text',
                    selector: '.item__name'
                },
                text: {
                    source: 'text',
                    selector: '.item__message',
                    type: 'string',
                    default: ''
                },
                clientAvatar: {
                    source: 'attribute',
                    selector: '.item__avatar img',
                    type: 'string',
                    attribute: 'src'
                }
            },
            default: []
        }
    },
    edit,
    save
})