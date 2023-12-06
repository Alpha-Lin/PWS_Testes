<ul> <!-- liste des questions -->
    {% for question in test.questions %}
        <li>{{question.question }}</li>
            <ul> <!-- liste des solutions-->
                {% for solution in question.solutions %}
                    <li>{{solution.nom}}." ".{{solution.critere}}.": ".{{solution.point}} </li>
                {% endfor %}
            </ul>
    {% endfor %}
</ul>