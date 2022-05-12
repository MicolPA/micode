<div class="row mb-3">
    <div class="col-md-12">
        <div class="bg-white pt-3">
           <p class="h5 text-center pb-3">PRECIOS POR PERSONAS</p>
            <table class="table" id="priceTable">
                <tr>
                    <th class="font-12 text-center p-0 border-0"></th>
                    <?php for ($i=1;$i<11;$i++): ?>
                        <th class="font-12 text-center p-0 border-0"><?= $i ?> PAX</th>
                    <?php endfor ?>
                    <th class="font-12 text-center p-0 border-0">11-15 PAX</th>
                    <th class="font-12 text-center p-0 border-0">16-20 PAX</th>
                    <th class="font-12 text-center p-0 border-0">>20 PAX</th>
                </tr>
                <tr>
                    <td class="p-0">
                        <input type="text" class="form-control text-center font-12 p-0" readonly value="Adultos" style="width: 80px">
                    </td>
                    <?php for ($i=1; $i<12;$i++): ?>
                        <?php 
                        $pack = \frontend\models\TouristPackagesPayments::find()->where(['tourist_packages_id' => $model['id'], 'from' => $i])->one();
                            $total = $pack ? $pack['adults_amount'] : null;
                         ?>
                        <td class="p-0">
                            <input type="number" name="adults[<?= $i ?>]" class="form-control text-center pr-0 pl-0" placeholder="N/A" value="<?= $total ?>">
                        </td>    
                    <?php endfor ?>
                    <td class="p-0">
                        <input type="number" name="adults[16]" class="form-control text-center pr-0 pl-0" placeholder="N/A">
                    </td>
                    <td class="p-0">
                        <input type="number" name="adults[20]" class="form-control text-center pr-0 pl-0" placeholder="N/A">
                    </td>
                </tr>
                <tr>
                    <td class="p-0">
                        <input type="text" class="form-control text-center font-12 p-0" readonly value="Níños" style="width: 80px">
                    </td>
                    <?php for ($i=1; $i<12;$i++): ?>
                        <?php 
                            $pack = \frontend\models\TouristPackagesPayments::find()->where(['tourist_packages_id' => $model['id'], 'from' => $i])->one();
                            $total = $pack ? $pack['kids_amount'] : null;
                        ?>
                        <td class="p-0">
                            <input type="number" name="kids[<?= $i ?>]" class="form-control text-center pr-0 pl-0" placeholder="N/A" value="<?= $total ?>">
                        </td>    
                    <?php endfor ?>
                    <td class="p-0">
                        <input type="number" name="kids[16]" class="form-control text-center pr-0 pl-0" placeholder="N/A">
                    </td>
                    <td class="p-0">
                        <input type="number" name="kids[20]" class="form-control text-center pr-0 pl-0" placeholder="N/A">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>