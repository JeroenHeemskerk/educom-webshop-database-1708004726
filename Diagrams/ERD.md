```mermaid
%%{`  More info on mermaid notation see: https://mermaid.js.org/syntax/entityRelationshipDiagram.html.  `}%%
erDiagram
    users ||--o{ orders : Places
    users {
        int    id        PK
        string name
        string email     UK
        string password
    }
    orders ||--|{ orders_content : items
    orders {
        int    id                PK
        int    user_id           FK
        date  date
        %%{` Fill in the rest of the properties `}%%        
    }
    orders_content {
        int id                   PK
        int order_id             FK
        int product_id           FK
        int product_count
    }
    products || --o{ orders_content : items
    products {
        int   id                PK
        string name             UK
        string description
        money price
        string image              
    }
```
