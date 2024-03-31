<div id="addActivity" class="popup">
    <div class="closeBtn">&times;</div>
    <div class="form">
        <h2>Add Activity</h2>
        <!-- Add Activity Form -->
        <form action="../handlers/add_activity_handler.php" method="POST">
            <!-- Activity Name -->
            <div class="form-element">
                <label for="activityName">Activity Name<span class="required">*</span></label>
                <input type="text" id="activityName" name="activityName" placeholder="Activity Name" required>
            </div>
            <!-- Activity Type -->
            <div class="form-element">
                <label for="activityType">Activity Type<span class="required">*</span></label>
                <select id="activityType" name="activityType" required>
                <?php
                    require_once __DIR__ . '/../includes/Dao.php';
                    $dao = new Dao();
                    $activityTypes = $dao->getActivityTypes();
            
                    foreach($activityTypes as $type) {
                        echo "<option value='{$type['ActivityType']}'>{$type['ActivityType']}</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Time of Day -->
            <div class="form-element">
                <label>Time of Day<span class="required">*</span></label>
                <div>
                    <input type="checkbox" id="morning" name="morning">
                    <label for="morning">Morning</label>
                    <input type="checkbox" id="afternoon" name="afternoon">
                    <label for="afternoon">Afternoon</label>
                    <input type="checkbox" id="evening" name="evening">
                    <label for="evening">Evening</label>
                </div>
            </div>
            <!-- Season -->
            <div class="form-element">
                <label for="season">Season<span class="required">*</span></label>
                <select id="season" name="season" required>
                    <option value="Any">Any</option>
                    <option value="Warm Weather">Warm Weather</option>
                    <option value="Cold Weather">Cold Weather</option>
                </select>
            </div>
            <!-- Address -->
            <div class="form-element">
                <label for="address">Address<span class="required">*</span></label>
                <input type="text" id="address" name="address" placeholder="Address" required>
            </div>
            <!-- City -->
            <div class="form-element">
                <label for="city">City<span class="required">*</span></label>
                <input type="text" id="city" name="city" placeholder="City" required>
            </div>
            <!-- State -->
            <div class="form-element">
                <label for="state">State<span class="required">*</span></label>
                <input type="text"  id="state" name="state" placeholder="State" required>
            </div>
            <!-- Zip -->
            <div class="form-element">
                <label for="zip">Zip<span class="required">*</span></label>
                <input type="number" id="zip" name="zip" placeholder="Zip" required>
            </div>
            <!-- Add Activity Button -->
            <div class="form-element">
                <button type="submit">Add Activity</button>
            </div>
        </form>
    </div>
</div>
