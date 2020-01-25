const { registerBlockType } = wp.blocks
const { RichText } = wp.editor

registerBlockType('fnwq/qualifications', {
    title: 'Workana Qualifications',
    category: 'widgets',
    attributes: {
        qualifications: {
            source: 'query',
            type: 'array',
            selector: 'li.qualifications__item',
            query: {
                clientName: {
                    type: 'string',
                    source: 'text',
                    selector: '.item__client'
                },
                text: {
                    source: 'text',
                    selector: '.item__message',
                    type: 'string',
                    default: ''
                }
            },
            default: []
        }
    },
    edit({className, attributes: {qualifications}, setAttributes}) {
        if( qualifications.length === 0)
            fetch(`${api.url}/fnwq/v1/qualifications`)
                .then(r => r.json())
                .then(qualifications => {
                    qualifications.forEach( item => {
                        item.clientName = item.client.name
                    })

                    setAttributes({qualifications})
                })
        else {
            console.log(qualifications)
        }
        return (
            <div className={className}>
                <ul className="qualifications">
                    {qualifications.map((item, index) => (
                            <li key={`${index}-${item}`} className="qualifications__item">
                                <span className="item__client">{item.clientName}</span> - <span className="item__message">{item.text}</span>
                            </li>
                    ))}
                </ul>
            </div>
        )
    },
    save({attributes: {qualifications}}) {
        return(
            <ul className="qualifications">
               {qualifications.map((item, index) => (
                    <li key={`${index}-${item}`} className="qualifications__item">
                        <span className="item__client">{item.clientName}</span> - <span className="item__message">{item.text}</span>
                    </li>
               ))}
            </ul>
        )
    }
})