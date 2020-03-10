Create Table If Not Exists `task_list_item_lists` (
`id` Int auto_increment,
`task_list_id` Int Not Null,
`creator_id` Int Not Null,
`title` Varchar(255) Not Null,
`creation_date` Date Not Null,
`order_criteria` Int Not Null,
Primary Key (`id`),
Constraint `task_list_parent` Foreign Key (`task_list_id`) References `task_lists`(`id`)
On Delete Cascade
On Update Cascade,
Constraint `task_list_creator` Foreign Key (`creator_id`) References `users`(`id`)
On Delete Cascade
On Update Cascade,
Constraint `task_lists_order_criteria` Foreign Key (`order_criteria`) References `task_lists_order_criteria`(`id`)
On Delete Cascade
On Update Cascade
);

<?php

class Task implements CRUD
{
    //Main
    private $task_id; //id
    private $title;
    private $description;
    private $creation_date;

    //Foreign keys
    private $creator_id;
    private $task_list_id;
    private $order_criteria;

    public function create(Type $var = null)
    {
        # code...
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function query()
    {

    }

    public function fill()
    {
        $this->$title = Utils::getCleanedData("title");
        $this->$description = Utils::getCleanedData("description");
        $this->$creation_date = Utils::getCleanedData("creationDate");

        $this->$creator_id = Utils::getCleanedData("creatorId");
        $this->$task_list_id = Utils::getCleanedData("taskListId");
        $this->$order_criteria = Utils::getCleanedData("orderCriteria");
    }

    public function parse()
    {
        return json_encode([
            "title" => $this->$title,
            "description" => $this->$description,
            "creationDate" => $this->$creation_date,
            "creatorId" => $this->$creator_id,
            "taskListId" => $this->$task_list_id,
            "orderCriteria" => $this->$order_criteria,
        ]);
    }
}